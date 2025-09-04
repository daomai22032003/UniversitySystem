@extends('layouts.app')

@section('title')
@endsection

@section('content')
<div class="container">
    <h2>Quản lý môn học</h2>

    <a href="{{ route('courses.create') }}" class="btn btn-primary mb-3">Thêm môn học</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
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
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->course_code }}</td>
                <td>{{ $course->course_name }}</td>
                <td>{{ $course->description }}</td>
                <td>{{ $course->credit }}</td>
                <td>{{ $course->status ? 'Hoạt động' : 'Ngưng' }}</td>
                <td>
                    <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('courses.destroy', $course) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc muốn xóa không?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $courses->links() }}
</div>
@endsection
