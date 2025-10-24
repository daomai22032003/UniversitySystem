@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="fw-bold text-primary mb-4">📘 Hồ sơ cá nhân sinh viên</h4>

    @if($student)
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <div class="row">
                {{-- Ảnh đại diện --}}
                <div class="col-md-4 text-center border-end">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" 
                         alt="Avatar" class="img-fluid rounded-circle mb-3" style="width: 150px;">
                    <h5 class="fw-bold text-primary">{{ $student->name }}</h5>
                    <p class="text-muted mb-1">Mã SV: <strong>{{ $student->student_code }}</strong></p>
                    <p class="text-muted">{{ $student->class?->class_name ?? 'Chưa có lớp' }}</p>
                    <span class="badge bg-success">{{ $student->class->department->name ?? 'Chưa có khoa' }}</span>
                </div>

                {{-- Thông tin chi tiết --}}
                <div class="col-md-8">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th class="text-secondary" width="30%">Ngày sinh</th>
                            <td>{{ $student->dob ? \Carbon\Carbon::parse($student->dob)->format('d/m/Y') : 'Chưa cập nhật' }}</td>
                        </tr>
                        <tr>
                            <th class="text-secondary">Giới tính</th>
                            <td>
                                @if($student->gender === 1)
                                    Nam
                                @elseif($student->gender === 0)
                                    Nữ
                                @else
                                    Chưa cập nhật
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="text-secondary">Email</th>
                            <td>{{ $student->email ?? 'Chưa cập nhật' }}</td>
                        </tr>
                        <tr>
                            <th class="text-secondary">Số điện thoại</th>
                            <td>{{ $student->phone ?? 'Chưa cập nhật' }}</td>
                        </tr>
                        <tr>
                            <th class="text-secondary">Lớp</th>
                            <td>{{ $student->class?->class_name ?? 'Chưa cập nhật' }}</td>
                        </tr>
                        <tr>
                            <th class="text-secondary">Khoa</th>
                            <td>{{ $student->class->department->name ?? 'Chưa cập nhật' }}</td>
                        </tr>
                    </table>

                    <div class="text-end mt-3">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Quay lại
                        </a>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit me-1"></i> Cập nhật hồ sơ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @else
        <div class="alert alert-warning mt-3">Không tìm thấy thông tin sinh viên.</div>
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
