@extends('layouts.app')

@section('title')
<title>Danh sách giảng viên</title>
@endsection

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <h3 class="fw-bold text-primary mb-0">Quản lý giảng viên</h3>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('teachers.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-1"></i> Thêm giảng viên
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-4">
        {{-- Form tìm kiếm --}}
        <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div class="card-body">
                <form action="{{ route('teachers.index') }}" method="GET" class="row g-2 align-items-center">
                    <div class="col-md-3">
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="form-control" placeholder="Nhập tên hoặc mã GV...">
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
                            <option value="">-- Tất cả lớp chủ nhiệm --</option>
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
                        <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary w-100">
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

        {{-- Bảng giảng viên --}}
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-0">
                <table class="table table-bordered table-hover align-middle text-center mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>STT</th>
                            <th>Mã GV</th>
                            <th>Họ tên</th>
                            <th>Lớp chủ nhiệm</th>
                            <th>Khoa</th>
                            <th>Email</th>
                            <th>Điện thoại</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teachers as $index => $teacher)
                        <tr>
                            <td>{{ $teachers->firstItem() + $index }}</td>
                            <td class="fw-semibold">{{ $teacher->teacher_code }}</td>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->class?->class_name ?? '—' }}</td>
                            <td>{{ $teacher->department?->name ?? '—' }}</td>
                            <td>{{ $teacher->email }}</td>
                            <td>{{ $teacher->phone }}</td>
                            <td>
                                <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST"
                                      class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa giảng viên này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-3">Không có dữ liệu giảng viên</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            {{ $teachers->links() }}
        </div>
    </div>
</main>
@endsection
