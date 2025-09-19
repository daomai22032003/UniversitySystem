@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thêm lớp</h2>
    <form action="{{ route('classes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Mã lớp</label>
            <input type="text" name="class_code" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tên lớp</label>
            <input type="text" name="class_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Khoa</label>
            <select name="department_id" class="form-control" required>
                @foreach($departments as $dep)
                <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                @endforeach
            </select>
        </div>
          <div class="mb-3">
            <label>Giảng viên phụ trách</label>
            <select name="teacher_id" class="form-control" required>
                <option value="">-- Chọn giảng viên --</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Năm học</label>
            <select name="academic_year_id" class="form-control" required>
                @foreach($academicYears as $year)
                <option value="{{ $year->id }}">{{ $year->term_name  }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('classes.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
