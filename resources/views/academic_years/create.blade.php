@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thêm năm học</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('academic_years.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tên năm học</label>
            <input type="text" name="year_name" class="form-control" value="{{ old('year_name') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Ngày bắt đầu</label>
            <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Ngày kết thúc</label>
            <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="1">Hoạt động</option>
                <option value="0">Không hoạt động</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('academic_years.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
