<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Department;
use App\Models\ClassModel;
use App\Models\AcademicYear;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['department','class','academicYear','user'])->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $departments = Department::all();
        $classes = ClassModel::all();
        $years = AcademicYear::all();
        $users = User::all();

        return view('students.create', compact('departments','classes','years','users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_code' => 'required|unique:students,student_code',
            'name' => 'required|string|max:100',
            'user_id' => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',
            'class_id' => 'required|exists:classes,id',
            'academic_year_id' => 'required|exists:academic_years,id',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success','Thêm sinh viên thành công!');
    }

    public function edit(Student $student)
    {
        $departments = Department::all();
        $classes = ClassModel::all();
        $years = AcademicYear::all();
        $users = User::all();

        return view('students.edit', compact('student','departments','classes','years','users'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'student_code' => 'required|max:20|unique:students,student_code,'.$student->id,
            'name' => 'required|string|max:100',
            'user_id' => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',
            'class_id' => 'required|exists:classes,id',
            'academic_year_id' => 'required|exists:academic_years,id',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')->with('success','Cập nhật sinh viên thành công!');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success','Xóa sinh viên thành công!');
    }
}
