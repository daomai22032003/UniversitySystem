@extends('layouts.app')

@section('title')
@endsection

@section('content')
<div class="container">
    <h2>Danh sách lớp</h2>
    <a href="{{ route('classes.create') }}" class="btn btn-success mb-3">+ Thêm lớp</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mã lớp</th>
                <th>Tên lớp</th>
                <th>Khoa</th>
                <th>Năm học</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classes as $class)
            <tr>
                <td>{{ $class->id }}</td>
                <td>{{ $class->class_code }}</td>
                <td>{{ $class->class_name }}</td>
                <td>{{ $class->department->name }}</td>
                <td>{{ $class->academicYear->year ?? '' }}</td>
                <td>{{ $class->status ? 'Hoạt động' : 'Ngừng' }}</td>
                <td>
                    <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                    <form action="{{ route('classes.destroy', $class->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Xóa lớp này?')" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $classes->links() }}
</div>
@endsection
