<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {    
         $query = Course::with(['department']);
        if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('course_code', 'like', "%$search%")
              ->orWhere('course_name', 'like', "%$search%");
        });
    }
        $courses = $query->paginate(10);
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_code' => 'required|unique:courses,course_code|max:50',
            'course_name' => 'required|string|max:100',
            'credit'     => 'required|integer|min:0',
        ]);

        Course::create($request->all());

        return redirect()->route('courses.index')->with('success', 'Thêm môn học thành công!');
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'course_code' => 'required|max:50|unique:courses,course_code,' . $course->id,
            'course_name' => 'required|string|max:100',
            'credit'     => 'required|integer|min:0',
        ]);

        $course->update($request->all());

        return redirect()->route('courses.index')->with('success', 'Cập nhật môn học thành công!');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Xóa môn học thành công!');
    }
}
