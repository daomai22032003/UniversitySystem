@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Danh sách giảng viên</h2>
   
    <div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('teachers.create') }}" class="btn btn-success">+ Thêm giảng viên</a>

    <form action="{{ route('teachers.index') }}" method="GET" class="d-flex" style="max-width: 300px;">
        <input type="text" name="search" value="{{ request('search') }}" 
               class="form-control me-2" placeholder="Nhập tên hoặc mã GV...">
        <button type="submit" class="btn btn-primary">Tìm</button>
    </form>
</div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã GV</th>
                <th>Họ tên</th>
                <th>Lớp</th>
                <th>Khoa</th>                
                <th>Email</th>
                <th>Điện thoại</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teachers as $teacher)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $teacher->teacher_code }}</td>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->class?->class_name }}</td>
                <td>{{ $teacher->department?->name }}</td>               
                <td>{{ $teacher->email }}</td>
                <td>{{ $teacher->phone }}</td>
                <td>
                    <a href="{{ route('teachers.edit',$teacher->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                    <form action="{{ route('teachers.destroy',$teacher->id) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $teachers->links() }}
</div>
@endsection
