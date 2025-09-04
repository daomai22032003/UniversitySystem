@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Danh sách sinh viên</h2>
    <a href="{{ route('students.create') }}" class="btn btn-success mb-3">+ Thêm sinh viên</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
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
