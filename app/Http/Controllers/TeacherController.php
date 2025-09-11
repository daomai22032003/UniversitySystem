<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Department;
use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class TeacherController extends Controller
{
   public function index(Request $request)
   {
    
    $query = Teacher::with(['department','class','user']); 
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('teacher_code', 'like', "%$search%")
              ->orWhere('name', 'like', "%$search%");
        });
    }
    $teachers = $query->paginate(10);

    return view('teachers.index', compact('teachers'));
}


    public function create()
    {
        $departments = Department::all();
        $classes = ClassModel::all();       
        return view('teachers.create', compact('departments','classes'));
    }

    public function store(Request $request)
    {
        if(User::where('email', $request->email)->exists()){
            return back()->with('error', 'Email đã tồn tại');
        }

        $request->validate([
            'teacher_code'     => 'required|unique:teachers,teacher_code|max:20',
            'name'             => 'required|string|max:100',
            'email'            => 'required|email|unique:users,email|max:100',
            'department_id'    => 'required|exists:departments,id',
            'class_id'         => 'required|exists:classes,id',           
        ]);

        $plainPassword = '12345';

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'username' => $request->teacher_code,
            'password' => Hash::make($plainPassword),
            'role'     => 'teacher',
        ]);

        Teacher::create([
            'teacher_code'     => $request->teacher_code,
            'name'             => $request->name,
            'email'            => $request->email,
            'phone'            => $request->phone, 
            'department_id'    => $request->department_id,
            'class_id'         => $request->class_id,           
            'user_id'          => $user->id,
        ]);

        return redirect()->route('teachers.index')
            ->with('success', "Thêm giảng viên thành công! Tài khoản: {$request->email} - Mật khẩu: {$plainPassword}");
    }

    public function edit(Teacher $teacher)
    {
        $departments = Department::all();
        $classes = ClassModel::all();       
        $users = User::all();
        return view('teachers.edit', compact('teacher','departments','classes','users'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'teacher_code'     => 'required|max:20|unique:teachers,teacher_code,'.$teacher->id,
            'name'             => 'required|string|max:100',
            'email'            => 'required|email|unique:users,email,'.$teacher->user_id,
            'department_id'    => 'required|exists:departments,id',
            'class_id'         => 'required|exists:classes,id',           
        ]);

        $teacher->user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        $teacher->update([
            'teacher_code'     => $request->teacher_code,
            'name'             => $request->name,
            'email'            => $request->email,
            'phone'            => $request->phone,
            'department_id'    => $request->department_id,
            'class_id'         => $request->class_id,           
        ]);

        return redirect()->route('teachers.index')->with('success','Cập nhật giảng viên thành công!');
    }

    public function destroy(Teacher $teacher)
    {
        if ($teacher->user) {
            $teacher->delete();
            $teacher->user->delete();
        }
        return redirect()->route('teachers.index')->with('success','Xóa giảng viên thành công!');
    }
}
