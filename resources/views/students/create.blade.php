@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thêm sinh viên</h2>
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Mã SV</label>
            <input type="text" name="student_code" class="form-control">
        </div>
        <div class="mb-3">
            <label>Họ tên</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="mb-3">
            <label>Người dùng</label>
            <select name="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Khoa</label>
            <select name="department_id" class="form-control">
                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Lớp</label>
            <select name="class_id" class="form-control" required>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Năm học</label>
            <select name="academic_year_id" class="form-control">
                @foreach($years as $year)
                    <option value="{{ $year->id }}">{{ $year->term_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="text" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label>Số điện thoại</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
