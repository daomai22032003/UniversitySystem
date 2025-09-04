@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thêm môn học</h2>

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Mã môn học</label>
            <input type="text" name="course_code" class="form-control" value="{{ old('course_code') }}">
            @error('course_code') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Tên môn học</label>
            <input type="text" name="course_name" class="form-control" value="{{ old('course_name') }}">
            @error('course_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Mô tả</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Số tín chỉ</label>
            <input type="number" name="credit" class="form-control" value="{{ old('credits', 0) }}">
            @error('credit') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
