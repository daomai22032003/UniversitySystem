@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chỉnh sửa lớp</h2>
    <form action="{{ route('classes.update', $class->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Mã lớp</label>
            <input type="text" name="class_code" value="{{ $class->class_code }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tên lớp</label>
            <input type="text" name="class_name" value="{{ $class->class_name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Khoa</label>
            <select name="department_id" class="form-control" required>
                @foreach($departments as $dep)
                <option value="{{ $dep->id }}" {{ $class->department_id == $dep->id ? 'selected' : '' }}>
                    {{ $dep->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
        <label>Kỳ Học</label>
        <select name="academic_year_id" class="form-control" required>
            @foreach($academicYears as $year)
                <option value="{{ $year->id }}" {{ $class->academic_year_id == $year->id ? 'selected' : '' }}>
                    {{ $year->term_name }}
                </option>
            @endforeach
        </select>
    </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('classes.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
