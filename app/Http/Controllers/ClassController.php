<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Department;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    // Hiển thị danh sách lớp
    public function index(Request $request)
    {   
         $query = ClassModel::with(['department', 'academicYear']);
        if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('class_code', 'like', "%$search%")
              ->orWhere('class_name', 'like', "%$search%");
        });
    }
     $classes = $query->paginate(10);
        return view('classes.index', compact('classes'));
    }


    // Form thêm mới
    public function create()
    {
        $departments = Department::all();
        $academicYears = AcademicYear::all();
        return view('classes.create', compact('departments', 'academicYears'));
    }

    // Lưu lớp mới
    public function store(Request $request)
    {
        $request->validate([
            'class_code' => 'required|unique:classes,class_code|max:20',
            'class_name' => 'required|max:100',
            'department_id' => 'required|exists:departments,id',
            'academic_year_id' => 'required|exists:academic_years,id'
        ]);

        ClassModel::create($request->all());
        return redirect()->route('classes.index')->with('success', 'Thêm lớp thành công!');
    }

    // Form chỉnh sửa
    public function edit($id)
    {
        $class = ClassModel::findOrFail($id);
        $departments = Department::all();
        $academicYears = AcademicYear::all();
        return view('classes.edit', compact('class', 'departments', 'academicYears'));
    }

    // Cập nhật
    public function update(Request $request, $id)
    {
        $class = ClassModel::findOrFail($id);

        $request->validate([
            'class_code' => 'required|max:20|unique:classes,class_code,' . $class->id,
            'class_name' => 'required|max:100',
            'department_id' => 'required|exists:departments,id',
            'academic_year_id' => 'required|exists:academic_years,id'
        ]);

        $class->update($request->all());
        return redirect()->route('classes.index')->with('success', 'Cập nhật lớp thành công!');
    }

    // Xoá
    public function destroy($id)
    {
        ClassModel::destroy($id);
        return redirect()->route('classes.index')->with('success', 'Xóa lớp thành công!');
    }
}
