<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Department;
use App\Models\ClassModel;
use App\Models\AcademicYear;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        
        return view('students.create', compact('departments','classes','years'));
    }

    public function store(Request $request)
    {
        if(User::where('email', $request->email)->exists()){
    return back()->with('error', 'email đã tồn tại');
       }
        $request->validate([
            'student_code'     => 'required|unique:students,student_code|max:20',
            'name'             => 'required|string|max:100',
            'email'            => 'required|email|unique:users,email|max:100',
            'department_id'    => 'required|exists:departments,id',
            'class_id'         => 'required|exists:classes,id',
            'academic_year_id' => 'required|exists:academic_years,id',
        ]);

        // Tạo mật khẩu ngẫu nhiên
        $plainPassword = '12345';

        // Tạo user mới
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'username' => $request->student_code,
            'password' => Hash::make($plainPassword),
            'role'     => 'student', // nếu có cột role
        ]);

        // Tạo student gắn với user
        Student::create([
            'student_code'     => $request->student_code,
            'name'             => $request->name,
            'email'            => $request->email,
            'phone'            => $request->phone, 
            'department_id'    => $request->department_id,
            'class_id'         => $request->class_id,
            'academic_year_id' => $request->academic_year_id,
            'user_id'          => $user->id,
        ]);

        return redirect()->route('students.index')
            ->with('success', "Thêm sinh viên thành công! Tài khoản: {$request->email} - Mật khẩu: {$plainPassword}");
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
            'student_code'     => 'required|max:20|unique:students,student_code,'.$student->id,
            'name'             => 'required|string|max:100',
            'email'            => 'required|email|unique:users,email,'.$student->user_id,
            'department_id'    => 'required|exists:departments,id',
            'class_id'         => 'required|exists:classes,id',
            'academic_year_id' => 'required|exists:academic_years,id',
        ]);

        // Update user
        $student->user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        // Update student
        $student->update([
            'student_code'     => $request->student_code,
            'name'             => $request->name,
            'email'            => $request->email,
            'phone'            => $request->phone,
            'department_id'    => $request->department_id,
            'class_id'         => $request->class_id,
            'academic_year_id' => $request->academic_year_id,
        ]);

        return redirect()->route('students.index')->with('success','Cập nhật sinh viên thành công!');
    }

    public function destroy(Student $student)
    {       
        if ($student->user) {
            $student->delete();         
            $student->user->delete();  
         }       
        return redirect()->route('students.index')->with('success','Xóa sinh viên thành công!');
    }
}
