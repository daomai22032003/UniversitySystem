@extends('layouts.app')

@section('title')
<title>Thêm Khoa</title>
@endsection

@section('content')
<div class="container">
    <h2>Thêm Khoa</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('departments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="code" class="form-label">Mã khoa</label>
            <input type="text" name="code" class="form-control" value="{{ old('code') }}" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Tên khoa</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Ngừng</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Thêm</button>
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
