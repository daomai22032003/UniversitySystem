@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chi tiết điểm</h2>

    <ul class="list-group">
        <li class="list-group-item"><b>Sinh viên:</b> {{ $grade->student->student_code }} - {{ $grade->student->name }}</li>
        <li class="list-group-item"><b>Môn học:</b> {{ $grade->course->course_code }} - {{ $grade->course->name }}</li>
        <li class="list-group-item"><b>Kỳ học:</b> {{ $grade->academicYear->term_name }}</li>
        <li class="list-group-item"><b>Điểm:</b> {{ $grade->grade }}</li>
    </ul>

    <a href="{{ route('grades.index') }}" class="btn btn-primary mt-3">Quay lại</a>
</div>
@endsection
