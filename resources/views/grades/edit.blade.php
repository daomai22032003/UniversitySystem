@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Sửa điểm</h2>

    <form action="{{ route('grades.update', $grade->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="student_id" class="form-label">Sinh viên</label>
            <select name="student_id" id="student_id" class="form-control" required>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" 
                        {{ $student->id == $grade->student_id ? 'selected' : '' }}>
                        {{ $student->student_code }} - {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="course_id" class="form-label">Môn học</label>
            <select name="course_id" id="course_id" class="form-control" required>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" 
                        {{ $course->id == $grade->course_id ? 'selected' : '' }}>
                        {{ $course->course_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="academic_year_id" class="form-label">Kỳ học</label>
            <select name="academic_year_id" id="academic_year_id" class="form-control" required>
                @foreach($academicYears as $year)
                    <option value="{{ $year->id }}" 
                        {{ $year->id == $grade->academic_year_id ? 'selected' : '' }}>
                        {{ $year->term_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="grade" class="form-label">Điểm</label>
            <input type="number" step="0.1" name="grade" id="grade" class="form-control" 
                   value="{{ $grade->grade }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('grades.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
