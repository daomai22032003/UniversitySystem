@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chỉnh sửa Khoa</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('departments.update', $department->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Mã Khoa</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $department->code) }}" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Tên khoa</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $department->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea name="description" class="form-control">{{ old('description', $department->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select name="status" class="form-select">
                <option value="1" {{ $department->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ $department->status == 0 ? 'selected' : '' }}>Ngừng hoạt động</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
