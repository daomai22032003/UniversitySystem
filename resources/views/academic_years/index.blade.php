@extends('layouts.app')

@section('title')
    <title>Trang chủ</title>
@endsection

@section('content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-3">
                <div class="col-md-6">
                    <h2 class="fw-bold mb-0">Danh sách năm học</h2>
                    <p class="text-muted mb-0">Quản lý các năm học và trạng thái hoạt động</p>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('academic_years.create') }}" class="btn btn-success shadow-sm">
                        <i class="bi bi-plus-lg"></i> Thêm năm học
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content Body-->
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th width="5%">STT</th>
                            <th>Tên kỳ</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Trạng thái</th>
                            <th width="20%">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($academicYears as $key => $year)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td>{{ $year->term_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($year->start_date)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($year->end_date)->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    @if($year->status == 1)
                                        <span class="badge bg-success">Hoạt động</span>
                                    @else
                                        <span class="badge bg-secondary">Ngưng</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('academic_years.edit', $year->id) }}" 
                                       class="btn btn-warning btn-sm me-1">
                                       <i class="bi bi-pencil-square"></i> Sửa
                                    </a>
                                    <form action="{{ route('academic_years.destroy', $year->id) }}" 
                                          method="POST" 
                                          style="display:inline;" 
                                          onsubmit="return confirm('Bạn có chắc chắn muốn xóa năm học này không?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i> Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Chưa có năm học nào được tạo</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Phân trang -->
                <div class="mt-3 d-flex justify-content-center">
                    {{ $academicYears->links() }}
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Body-->
</main>
@endsection
