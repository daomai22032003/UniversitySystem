@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h2 class="mb-0">Danh sách điểm</h2>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
        <a href="{{ route('grades.create') }}" class="btn btn-success px-3 py-2">+ Thêm điểm</a>
        <form method="GET" action="{{ route('grades.index') }}" class="d-flex mb-3" style="max-width: 100%;">
             <input type="text" name="search" value="{{ request('search') }}"
           class="form-control me-2" placeholder="Nhập tên,mã SV...">
            <select name="class_id" class="form-select me-2">
                <option value="">-- Tất cả lớp --</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                        {{ $class->class_name }}
                    </option>
                @endforeach
            </select>
            <select name="course_id" class="form-select me-2">
                <option value="">-- Tất cả môn --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                        {{ $course->course_name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary px-3 py-2">Tìm</button>
        </form>
    </div>

    {{-- Thông báo --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Bảng điểm --}}
    @foreach($gradesByClass as $className => $grades)
        <h4 class="mt-4">Lớp: {{ $className }}</h4>
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>Mã SV</th>
                    <th>Tên SV</th>
                    <th>Môn học</th>
                    <th>Kỳ học</th>
                    <th>Điểm</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($grades as $grade)
                    <tr>
                        <td>{{ $grade->student->student_code }}</td>
                        <td>{{ $grade->student->name }}</td>
                        <td>{{ $grade->course->course_name }}</td>
                        <td>{{ $grade->academicYear->term_name }}</td>
                        <td>{{ $grade->grade }}</td>
                        <td>
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('grades.edit', $grade->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('grades.destroy', $grade->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Không có dữ liệu</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endforeach
</div>
@endsection
