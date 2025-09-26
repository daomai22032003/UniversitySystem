@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thêm điểm mới</h2>

    <form action="{{ route('grades.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="student_id" class="form-label">Sinh viên</label>
            <select name="student_id" id="student_id" class="form-control" required>
                <option value="">-- Chọn sinh viên --</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->student_code }} - {{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="course_id" class="form-label">Môn học</label>
            <select name="course_id" id="course_id" class="form-control" required>
                <option value="">-- Chọn môn học --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="academic_year_id" class="form-label">Kỳ học</label>
            <select name="academic_year_id" id="academic_year_id" class="form-control" required>
                <option value="">-- Chọn kỳ học --</option>
                @foreach($academicYears as $year)
                    <option value="{{ $year->id }}">{{ $year->term_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="grade" class="form-label">Điểm</label>
            <input type="number" step="0.1" name="grade" id="grade" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('grades.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
