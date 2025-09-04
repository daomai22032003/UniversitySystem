@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chỉnh sửa sinh viên</h2>
    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Mã SV</label>
            <input type="text" name="student_code" class="form-control" 
                   value="{{ old('student_code', $student->student_code) }}">
            @error('student_code') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Họ tên</label>
            <input type="text" name="name" class="form-control" 
                   value="{{ old('name', $student->name) }}">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Người dùng</label>
            <select name="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" 
                        {{ $student->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->username }}
                    </option>
                @endforeach
            </select>
            @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Khoa</label>
            <select name="department_id" class="form-control">
                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}" 
                        {{ $student->department_id == $dept->id ? 'selected' : '' }}>
                        {{ $dept->name }}
                    </option>
                @endforeach
            </select>
            @error('department_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Lớp</label>
            <select name="class_id" class="form-control">
                @foreach($classes as $class)
                    <option value="{{ $class->id }}" 
                        {{ $student->class_id == $class->id ? 'selected' : '' }}>
                        {{ $class->class_name }}
                    </option>
                @endforeach
            </select>
            @error('class_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Năm học</label>
            <select name="academic_year_id" class="form-control">
                @foreach($years as $year)
                    <option value="{{ $year->id }}" 
                        {{ $student->academic_year_id == $year->id ? 'selected' : '' }}>
                        {{ $year->term_name }}
                    </option>
                @endforeach
            </select>
            @error('academic_year_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="text" name="email" class="form-control" 
                   value="{{ old('email', $student->email) }}">
        </div>

        <div class="mb-3">
            <label>Số điện thoại</label>
            <input type="text" name="phone" class="form-control" 
                   value="{{ old('phone', $student->phone) }}">
        </div>

        <div class="mb-3">
            <label>Địa chỉ</label>
            <textarea name="address" class="form-control">{{ old('address', $student->address) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Trạng thái</label>
            <select name="status" class="form-control">
                <option value="1" {{ $student->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ $student->status == 0 ? 'selected' : '' }}>Ngừng</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
