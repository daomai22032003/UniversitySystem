<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentGradeController extends Controller
{
    /**
     * Hiển thị bảng điểm của sinh viên hiện tại
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // ✅ Kiểm tra quyền truy cập
        if (!$user || !$user->student) {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        $student = $user->student;

        // ✅ Lấy danh sách năm học để filter
        $academicYears = AcademicYear::orderBy('term_name', 'asc')->get();

        // ✅ Truy vấn danh sách điểm
        $query = Grade::with(['course', 'academicYear'])
            ->where('student_id', $student->id);

        // Lọc theo năm học (nếu có)
        if ($request->filled('academic_year_id')) {
            $query->where('academic_year_id', $request->academic_year_id);
        }

        $grades = $query->get();

        // ✅ Tính GPA theo từng năm học
        $gpaByYear = $grades->groupBy('academic_year_id')->map(function ($gradesInYear) {
            $totalCredits = $gradesInYear->sum(fn($g) => optional($g->course)->credit ?? 0);
            $weighted = $gradesInYear->sum(fn($g) => (optional($g->course)->credit ?? 0) * $g->grade);

            return $totalCredits > 0 ? round($weighted / $totalCredits, 2) : 0;
        });

        // ✅ Tính GPA toàn khóa
        $totalCredits = $grades->sum(fn($g) => optional($g->course)->credit ?? 0);
        $weightedTotal = $grades->sum(fn($g) => (optional($g->course)->credit ?? 0) * $g->grade);
        $overallGPA = $totalCredits > 0 ? round($weightedTotal / $totalCredits, 2) : 0;

        // ✅ Trả dữ liệu về view
        return view('students.grades', [
            'grades' => $grades,
            'academicYears' => $academicYears,
            'gpaByYear' => $gpaByYear,
            'overallGPA' => $overallGPA,
        ]);
    }
}
