<?php
namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::paginate(10);
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:departments,code|max:20',
            'name' => 'required|max:100',
            'description' => 'nullable',
            'status' => 'boolean'
        ]);

        Department::create($request->all());
        return redirect()->route('departments.index')->with('success', 'Thêm khoa thành công!');
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'code' => 'required|max:20|unique:departments,code,'.$department->id,
            'name' => 'required|max:100',
            'description' => 'nullable',
            'status' => 'boolean'
        ]);

        $department->update($request->all());
        return redirect()->route('departments.index')->with('success', 'Cập nhật khoa thành công!');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Xóa khoa thành công!');
    }
}
