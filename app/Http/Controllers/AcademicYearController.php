<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
   
    public function index()
    {
        $academicYears = AcademicYear::paginate(10); 
        return view('academic_years.index', compact('academicYears'));
    }    
    public function create()
    {
        return view('academic_years.create');
    }   
    public function store(Request $request)
    {
        $request->validate([
            'year_name' => 'required|unique:academic_years,year_name|max:50',
            'start_date' => 'nullable|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
        ]);

        AcademicYear::create($request->all());

        return redirect()->route('academic_years.index')
            ->with('success', 'Thêm năm học thành công!');
    }   

    public function edit(AcademicYear $academicYear)
    {
        return view('academic_years.edit', compact('academicYear'));
    }

    public function update(Request $request, AcademicYear $academicYear)
    {
        $request->validate([
            'year_name' => 'required|max:50|unique:academic_years,year_name,' . $academicYear->id,
            'start_date' => 'nullable|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
        ]);

        $academicYear->update($request->all());

        return redirect()->route('academic_years.index')
            ->with('success', 'Cập nhật năm học thành công!');
    }

    
    public function destroy(AcademicYear $academicYear)
    {
        $academicYear->delete();

        return redirect()->route('academic_years.index')
            ->with('success', 'Xóa năm học thành công!');
    }
}
