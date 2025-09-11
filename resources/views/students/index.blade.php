@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Danh sách sinh viên</h2>  
     <div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('students.create') }}" class="btn btn-success">+ Thêm sinh viên</a>
    <form action="{{ route('students.index') }}" method="GET" class="d-flex mb-3" style="max-width: 100%;">    
    <input type="text" name="search" value="{{ request('search') }}"
           class="form-control me-2" placeholder="Nhập tên,mã SV...">
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
                <th>Mã SV</th>
                <th>Họ tên</th>
                <th>Lớp</th>
                <th>Khoa</th>
                <th>Năm học</th>
                <th>Email</th>
                <th>Điện thoại</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $student->student_code }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->class?->class_name }}</td>
                <td>{{ $student->department?->name }}</td>
                <td>{{ $student->academicYear?->term_name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->phone }}</td>
                <td>
                    <a href="{{ route('students.edit',$student->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                    <form action="{{ route('students.destroy',$student->id) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $students->links() }}
</div>
@endsection
