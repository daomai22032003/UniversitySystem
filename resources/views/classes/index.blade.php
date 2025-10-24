@extends('layouts.app')

@section('title')
<title>Danh sách lớp học</title>
@endsection

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <h3 class="fw-bold text-primary mb-0">Danh sách lớp học</h3>
                </div>
                <div class="col-sm-6 text-end">
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('classes.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-circle me-1"></i> Thêm lớp
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
                <form action="{{ route('classes.index') }}" method="GET" class="row g-2 align-items-center">
                    <div class="col-md-4">
                        <input type="text" name="search" value="{{ request('search') }}" 
                            class="form-control" placeholder="Nhập mã hoặc tên lớp...">
                    </div>
                    <div class="col-md-4">
                        <select name="department_id" class="form-select">
                            <option value="">-- Tất cả khoa --</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" 
                                    {{ request('department_id') == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-1"></i> Tìm kiếm
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('classes.index') }}" class="btn btn-outline-secondary w-100">
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

        {{-- Bảng danh sách --}}
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>STT</th>
                            <th>Mã lớp</th>
                            <th>Tên lớp</th>
                            <th>Khoa</th>
                            <th>Kỳ học</th>
                            <th>Giảng viên phụ trách</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($classes as $class)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $class->class_code }}</td>
                                <td>
                                    <a href="{{ route('students.index', ['class_id' => $class->id]) }}" 
                                       class="text-decoration-none text-primary fw-semibold">
                                        {{ $class->class_name }}
                                    </a>
                                </td>
                                <td>{{ $class->department->name ?? '-' }}</td>
                                <td>{{ $class->academicYear->term_name ?? '-' }}</td>
                                <td>{{ $class->teacher->name ?? 'Chưa có' }}</td>
                                <td>
                                    @if($class->status == 1)
                                        <span class="badge bg-success px-3 py-2">Hoạt động</span>
                                    @else
                                        <span class="badge bg-secondary px-3 py-2">Không hoạt động</span>
                                    @endif
                                </td>
                                <td>
                                    @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('classes.edit', $class->id) }}" 
                                           class="btn btn-warning btn-sm me-1">
                                           <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('classes.destroy', $class->id) }}" method="POST" 
                                              class="d-inline" 
                                              onsubmit="return confirm('Bạn có chắc muốn xóa lớp này?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Không có dữ liệu lớp học</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Phân trang --}}
                <div class="mt-3">
                    {{ $classes->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
