<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\AcademicYear;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class GradeController extends Controller
{
    // Hiển thị danh sách điểm
  public function index(Request $request)
    {
        $query = Grade::with(['student.class', 'course', 'academicYear']);

        $user = Auth::user();

        // Nếu là giảng viên: chỉ lấy điểm sinh viên lớp mình phụ trách
        if ($user && $user->role === 'teacher') {
            $teacher = Teacher::where('user_id', $user->id)->first();

            if ($teacher) {
                $query->whereHas('student.class', function ($q) use ($teacher) {
                    $q->where('teacher_id', $teacher->id);
                });
            }
        }
        if ($request->filled('search')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('student_code', 'like', '%' . $request->search . '%');
            });
        }

        // Lọc theo lớp
        if ($request->filled('class_id')) {
            $query->whereHas('student.class', function ($q) use ($request) {
                $q->where('id', $request->class_id);
            });
        }
        
        // Lọc theo môn học
        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        // Lấy dữ liệu
        $grades = $query->get();

        // Nếu không lọc theo lớp, có thể vẫn muốn nhóm theo lớp để hiển thị
        $gradesByClass = $grades->groupBy(function ($grade) {
            return $grade->student->class->class_name ?? 'Chưa có lớp';
        });
        
        // Dropdown filters
        $classes = ClassModel::all();
        $courses = Course::all();

        return view('grades.index', compact('gradesByClass', 'classes', 'courses'));
    }

    public function showByStudent($id)
    {
        $student = \App\Models\Student::with(['grades.course', 'class'])->findOrFail($id);
        $teacher = auth()->user()->teacher;

        // Nếu muốn kiểm tra quyền (chỉ cho xem sinh viên lớp chủ nhiệm)
        if ($teacher && $student->class->teacher_id !== $teacher->id) {
            abort(403, 'Bạn không có quyền xem điểm của sinh viên này.');
        }

        return view('grades.student_scores', compact('student'));
    }

    // Form thêm mới
    public function create()
    {
        $students = Student::all();
        $courses = Course::all();
        $academicYears = AcademicYear::all();

        return view('grades.create', compact('students', 'courses', 'academicYears'));
    }

    // Lưu điểm mới
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'grade' => 'required|numeric|min:0|max:10',
        ]);

        Grade::create($request->all());

        return redirect()->route('grades.index')->with('success', 'Thêm điểm thành công!');
    }

    // Hiển thị chi tiết 1 điểm
    public function show(Grade $grade)
    {
        return view('grades.show', compact('grade'));
    }

    // Form sửa
    public function edit(Grade $grade)
    {
        $students = Student::all();
        $courses = Course::all();
        $academicYears = AcademicYear::all();

        return view('grades.edit', compact('grade', 'students', 'courses', 'academicYears'));
    }

    // Cập nhật điểm
    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'grade' => 'required|numeric|min:0|max:10',
        ]);

        $grade->update($request->all());

        return redirect()->route('grades.index')->with('success', 'Cập nhật điểm thành công!');
    }

    // Xóa điểm
    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Xóa điểm thành công!');
    }
}
