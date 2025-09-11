@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thêm giảng viên</h2>
    <form action="{{ route('teachers.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="teacher_code" class="form-label">Mã GV</label>
            <input type="text" name="teacher_code" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Họ tên</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="class_id" class="form-label">Lớp</label>
            <select name="class_id" class="form-control" required>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="mb-3">
            <label for="department_id" class="form-label">Khoa</label>
            <select name="department_id" class="form-control" required>
                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                @endforeach
            </select>
        </div>

           
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
