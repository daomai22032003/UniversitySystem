@extends('layouts.app')

@section('title')
<title>Trang chủ</title>
@endsection

@section('content')

  <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
             
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
       <div class="card-body">
    <table class="table table-bordered table-hover">
        <thead>
          <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Danh sách năm học</h2>
    <a href="{{ route('academic_years.create') }}" class="btn btn-success">
        + Thêm năm học
    </a>
</div>


            <tr>
                <th>ID</th>
                <th>Tên năm học</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($academicYears as $year)
            
            <tr>
                <td>{{ $year->id }}</td>
                    <td>{{ $year->year_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($year->start_date)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($year->end_date)->format('d/m/Y') }}</td>
                    <td>
                        @if($year->status == 1)
                            <span class="badge bg-success">Hoạt động</span>
                        @else
                            <span class="badge bg-secondary">Ngưng</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('academic_years.edit', $year->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('academic_years.destroy', $year->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa năm học này không?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
            </tr>
             @endforeach
        </tbody>
    </table>
    <div class="mt-3">
       {{ $academicYears->links() }}
    </div>
</div>

          <!--end::App Content-->
        </main>

        @endsection



