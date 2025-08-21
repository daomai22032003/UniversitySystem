@extends('layouts.app')

@section('title', 'Danh sách năm học')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Danh sách năm học</h3>
        <a href="{{ route('academic_years.create') }}" class="btn btn-primary">+ Thêm năm học</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
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
                    <td>{{ $year->name }}</td>
                    <td>{{ $year->start_date }}</td>
                    <td>{{ $year->end_date }}</td>
                    <td>
                        @if($year->status == 1)
                            <span class="badge badge-success">Hoạt động</span>
                        @else
                            <span class="badge badge-secondary">Ngưng</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('academic_years.edit', $year->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('academic_years.destroy', $year->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
