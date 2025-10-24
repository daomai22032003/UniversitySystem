@extends('layouts.app')

@section('title')
<title>Danh sách sinh viên</title>
@endsection

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <h3 class="fw-bold text-primary mb-0">Quản lý sinh viên</h3>
                </div>
                <div class="col-sm-6 text-end">
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('students.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-1"></i> Thêm sinh viên
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
                <form action="{{ route('students.index') }}" method="GET" class="row g-2 align-items-center">
                    <div class="col-md-3">
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="form-control" placeholder="Nhập tên hoặc mã SV...">
                    </div>

                    <div class="col-md-3">
                        <select name="department_id" class="form-select">
                            <option value="">-- Tất cả khoa --</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ request('department_id') == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="class_id" class="form-select">
                            <option value="">-- Tất cả lớp --</option>
                            @foreach($classes as $cls)
                                <option value="{{ $cls->id }}" {{ request('class_id') == $cls->id ? 'selected' : '' }}>
                                    {{ $cls->class_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 d-flex">
                        <button type="submit" class="btn btn-primary w-100 me-2">
                            <i class="bi bi-search me-1"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary w-100">
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

        {{-- Danh sách sinh viên --}}
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-0">
                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>STT</th>
                            <th>Mã SV</th>
                            <th>Họ tên</th>
                            <th>Lớp</th>
                            <th>Khoa</th>
                            <th>Năm học</th>
                            <th>Email</th>
                            <th>Điện thoại</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $index => $student)
                        <tr>
                            <td>{{ $students->firstItem() + $index }}</td>
                            <td class="fw-semibold">{{ $student->student_code }}</td>
                            <td>
                                <a href="{{ route('teacher.student.scores', $student->id) }}" class="text-decoration-none fw-medium">
                                    {{ $student->name }}
                                </a>
                            </td>
                            <td>{{ $student->class?->class_name }}</td>
                            <td>{{ $student->department?->name }}</td>
                            <td>{{ $student->academicYear?->term_name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('students.edit', $student->id) }}" 
                                       class="btn btn-warning btn-sm me-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                          class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa sinh viên này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">---</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-3">Không có dữ liệu sinh viên</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            {{ $students->links() }}
        </div>
    </div>
</main>
@endsection
