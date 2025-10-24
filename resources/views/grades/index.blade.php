@extends('layouts.app')

@section('title')
<title>Quản lý điểm</title>
@endsection

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <h3 class="fw-bold text-primary mb-0">Quản lý điểm</h3>
                </div>
                <div class="col-sm-6 text-end">
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('grades.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-1"></i> Thêm điểm
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-4">
        {{-- Form tìm kiếm --}}
        <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('grades.index') }}" class="row g-2 align-items-center">
                    <div class="col-md-3">
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="form-control" placeholder="Nhập tên hoặc mã SV...">
                    </div>

                    <div class="col-md-3">
                        <select name="class_id" class="form-select">
                            <option value="">-- Tất cả lớp --</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                    {{ $class->class_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="course_id" class="form-select">
                            <option value="">-- Tất cả môn --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->course_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 d-flex">
                        <button type="submit" class="btn btn-primary w-100 me-2">
                            <i class="bi bi-search me-1"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('grades.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-arrow-repeat me-1"></i> Làm mới
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Thông báo --}}
        @if(session('success'))
            <div class="alert alert-success shadow-sm rounded-3">{{ session('success') }}</div>
        @endif

        {{-- Danh sách điểm --}}
        @forelse($gradesByClass as $className => $grades)
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-header bg-light fw-semibold">
                    <i class="bi bi-people-fill text-primary me-2"></i> Lớp: {{ $className }}
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-hover align-middle text-center mb-0">
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
                                    <td class="fw-semibold">{{ $grade->student->student_code }}</td>
                                    <td>{{ $grade->student->name }}</td>
                                    <td>{{ $grade->course->course_name }}</td>
                                    <td>{{ $grade->academicYear->term_name }}</td>
                                    <td>
                                        <span class="badge bg-info text-dark px-3 py-2">
                                            {{ $grade->grade }}
                                        </span>
                                    </td>
                                    <td>
                                        @if(auth()->user()->role === 'admin')
                                            <a href="{{ route('grades.edit', $grade->id) }}" 
                                               class="btn btn-warning btn-sm me-1">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('grades.destroy', $grade->id) }}" 
                                                  method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-3">Không có dữ liệu điểm</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <div class="alert alert-secondary text-center">Không có lớp nào có điểm.</div>
        @endforelse
    </div>
</main>
@endsection
