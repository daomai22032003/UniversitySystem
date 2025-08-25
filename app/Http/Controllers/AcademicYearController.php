<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Http\Requests\StoreAcademicYearRequest;
use App\Http\Requests\UpdateAcademicYearRequest;

class AcademicYearController extends Controller
{
    public function index()
{
    $academicYears = \App\Models\AcademicYear::paginate(10); 
    return view('academic_years.index', compact('academicYears'));
}



    public function create()
    {
        return view('academic_years.create');
    }

    public function store(StoreAcademicYearRequest $request)
    {
        AcademicYear::create($request->validated());

        return redirect()->route('academic_years.index')
            ->with('success', 'Thêm năm học thành công!');
    }

    public function edit(AcademicYear $academicYear)
    {
        return view('academic_years.edit', compact('academicYear'));
    }

    public function update(UpdateAcademicYearRequest $request, AcademicYear $academicYear)
    {
        $academicYear->update($request->validated());

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
