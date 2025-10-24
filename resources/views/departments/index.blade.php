@extends('layouts.app')

@section('title')
<title>Quản lý Khoa</title>
@endsection

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <h3 class="fw-bold text-primary mb-0">Quản lý Khoa</h3>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('departments.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-1"></i> Thêm Khoa
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-4">
        {{-- Form tìm kiếm --}}
        <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div class="card-body">
                <form action="{{ route('departments.index') }}" method="GET" class="row g-2 align-items-center">
                    <div class="col-md-6">
                        <input type="text" name="search" value="{{ request('search') }}" 
                            class="form-control" placeholder="Nhập mã hoặc tên khoa...">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-1"></i> Tìm kiếm
                        </button>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary w-100">
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
                            <th>Mã khoa</th>
                            <th>Tên khoa</th>
                            <th>Mô tả</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($departments as $key => $dep)
                            <tr>
                                <td>{{ $departments->firstItem() + $key }}</td>
                                <td class="fw-semibold">{{ $dep->code }}</td>
                                <td>{{ $dep->name }}</td>
                                <td class="text-start">{{ $dep->description ?? '-' }}</td>
                                <td>
                                    @if($dep->status)
                                        <span class="badge bg-success px-3 py-2">Hoạt động</span>
                                    @else
                                        <span class="badge bg-secondary px-3 py-2">Ngừng</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('departments.edit', $dep->id) }}" 
                                       class="btn btn-warning btn-sm me-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('departments.destroy', $dep->id) }}" method="POST" 
                                          class="d-inline" 
                                          onsubmit="return confirm('Bạn có chắc muốn xóa khoa này không?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Không có dữ liệu khoa</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Phân trang --}}
                <div class="mt-3">
                    {{ $departments->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
