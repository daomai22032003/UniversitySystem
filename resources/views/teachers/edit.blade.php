@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chỉnh sửa giảng viên</h2>
    <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Mã GV</label>
            <input type="text" name="teacher_code" class="form-control" 
                   value="{{ old('teacher_code', $teacher->teacher_code) }}">
            @error('teacher_code') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Họ tên</label>
            <input type="text" name="name" class="form-control" 
                   value="{{ old('name', $teacher->name) }}">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Người dùng</label>
            <select name="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" 
                        {{ $teacher->user_id == $user->id ? 'selected' : '' }}>
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
                        {{ $teacher->department_id == $dept->id ? 'selected' : '' }}>
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
                        {{ $teacher->class_id == $class->id ? 'selected' : '' }}>
                        {{ $class->class_name }}
                    </option>
                @endforeach
            </select>
            @error('class_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>        
        <div class="mb-3">
            <label>Email</label>
            <input type="text" name="email" class="form-control" 
                   value="{{ old('email', $teacher->email) }}">
        </div>

        <div class="mb-3">
            <label>Số điện thoại</label>
            <input type="text" name="phone" class="form-control" 
                   value="{{ old('phone', $teacher->phone) }}">
        </div>

        <div class="mb-3">
            <label>Địa chỉ</label>
            <textarea name="address" class="form-control">{{ old('address', $teacher->address) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Trạng thái</label>
            <select name="status" class="form-control">
                <option value="1" {{ $teacher->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ $teacher->status == 0 ? 'selected' : '' }}>Ngừng</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
