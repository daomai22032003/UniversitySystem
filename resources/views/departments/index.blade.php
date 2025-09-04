@extends('layouts.app')

@section('title')
@endsection

@section('content')
<div class="container">
    <h2>Danh sách Khoa</h2>

    <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3">Thêm Khoa</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã khoa</th>
                <th>Tên khoa</th>
                <th>Mô tả</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $key => $dep)
                <tr>
                    <td>{{ $departments->firstItem() + $key }}</td>
                    <td>{{ $dep->code }}</td>
                    <td>{{ $dep->name }}</td>
                    <td>{{ $dep->description }}</td>
                    <td>{{ $dep->status ? 'Hoạt động' : 'Ngừng' }}</td>
                    <td>
                        <a href="{{ route('departments.edit', $dep->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('departments.destroy', $dep->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa khoa này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $departments->links() }}
</div>
@endsection
