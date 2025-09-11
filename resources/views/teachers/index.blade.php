@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Danh sách giảng viên</h2>
   
    <div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('teachers.create') }}" class="btn btn-success">+ Thêm giảng viên</a>
     <form action="{{ route('teachers.index') }}" method="GET" class="d-flex mb-3" style="max-width: 100%;">    
    <input type="text" name="search" value="{{ request('search') }}"
           class="form-control me-2" placeholder="Nhập tên,mã GV...">
    <select name="department_id" class="form-select me-2">
        <option value="">-- Tất cả khoa --</option>
        @foreach($departments as $dept)
            <option value="{{ $dept->id }}" {{ request('department_id') == $dept->id ? 'selected' : '' }}>
                {{ $dept->name }}
            </option>
        @endforeach
    </select>
    <select name="class_id" class="form-select me-2">
        <option value="">-- Tất cả lớp --</option>
        @foreach($classes as $cls)
            <option value="{{ $cls->id }}" {{ request('class_id') == $cls->id ? 'selected' : '' }}>
                {{ $cls->class_name }}
            </option>
        @endforeach
    </select>
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
