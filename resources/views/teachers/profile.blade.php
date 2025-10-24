@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="fw-bold text-primary mb-4">👨‍🏫 Hồ sơ cá nhân giảng viên</h4>

    @if($teacher)
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <div class="row">
                {{-- Ảnh đại diện --}}
                <div class="col-md-4 text-center border-end">
                    <img src="https://cdn-icons-png.flaticon.com/512/4140/4140048.png"
                         alt="Avatar" class="img-fluid rounded-circle mb-3" style="width: 150px;">
                    <h5 class="fw-bold text-primary">{{ $teacher->name }}</h5>
                    <p class="text-muted mb-1">Mã GV: <strong>{{ $teacher->teacher_code ?? '—' }}</strong></p>
                    <span class="badge bg-success">{{ $teacher->department->name ?? 'Chưa có khoa' }}</span>
                </div>

                {{-- Thông tin chi tiết --}}
                <div class="col-md-8">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th class="text-secondary" width="30%">Email</th>
                            <td>{{ $teacher->email ?? 'Chưa cập nhật' }}</td>
                        </tr>
                        <tr>
                            <th class="text-secondary">Số điện thoại</th>
                            <td>{{ $teacher->phone ?? 'Chưa cập nhật' }}</td>
                        </tr>
                        <tr>
                            <th class="text-secondary">Khoa</th>
                            <td>{{ $teacher->department->name ?? 'Chưa cập nhật' }}</td>
                        </tr>
                        <tr>
                            <th class="text-secondary">Ngày tạo tài khoản</th>
                            <td>{{ $teacher->created_at ? $teacher->created_at->format('d/m/Y') : '—' }}</td>
                        </tr>
                    </table>

                    <div class="text-end mt-3">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Quay lại
                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    @else
        <div class="alert alert-warning mt-3">Không tìm thấy thông tin giảng viên.</div>
    @endif
</div>

<style>
.card {
    transition: 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
}
th {
    font-weight: 600;
}
</style>
@endsection
