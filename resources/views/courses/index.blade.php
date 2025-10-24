@extends('layouts.app')

@section('title')
<title>Quản lý môn học</title>
@endsection

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <h3 class="fw-bold text-primary mb-0">Quản lý môn học</h3>
                </div>
                <div class="col-sm-6 text-end">
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('courses.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-circle me-1"></i> Thêm môn học
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
                <form action="{{ route('courses.index') }}" method="GET" class="row g-2 align-items-center">
                    <div class="col-md-6">
                        <input type="text" name="search" value="{{ request('search') }}" 
                            class="form-control" placeholder="Nhập mã hoặc tên môn học...">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-1"></i> Tìm kiếm
                        </button>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary w-100">
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
                            <th>Mã môn học</th>
                            <th>Tên môn học</th>
                            <th>Mô tả</th>  
                            <th>Số tín chỉ</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $course->course_code }}</td>
                                <td>{{ $course->course_name }}</td>
                                <td class="text-start">{{ $course->description ?? '-' }}</td>
                                <td>{{ $course->credit }}</td>
                                <td>
                                    @if($course->status)
                                        <span class="badge bg-success px-3 py-2">Hoạt động</span>
                                    @else
                                        <span class="badge bg-secondary px-3 py-2">Ngưng</span>
                                    @endif
                                </td>
                                <td>
                                    @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('courses.edit', $course->id) }}" 
                                           class="btn btn-warning btn-sm me-1">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" 
                                              class="d-inline" 
                                              onsubmit="return confirm('Bạn có chắc muốn xóa môn học này không?');">
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
                                <td colspan="7" class="text-center text-muted">Không có dữ liệu môn học</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Phân trang --}}
                <div class="mt-3">
                    {{ $courses->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
