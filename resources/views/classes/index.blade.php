@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Danh sách lớp</h2>
   
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('classes.create') }}" class="btn btn-success">+ Thêm lớp</a>       
        <form action="{{ route('classes.index') }}" method="GET" class="d-flex" style="max-width: 500px;">        
            <input type="text" name="search" value="{{ request('search') }}" 
                   class="form-control me-2" placeholder="Nhập mã lớp,tên lớp...">
           
            <select name="department_id" class="form-select me-2">
                <option value="">-- Tất cả khoa --</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}" 
                        {{ request('department_id') == $dept->id ? 'selected' : '' }}>
                        {{ $dept->name }}
                    </option>
                @endforeach
            </select>

            <!-- Nút tìm -->
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
                <th>Mã lớp</th>
                <th>Tên lớp</th>
                <th>Khoa</th>
                <th>Kỳ Học</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classes as $class)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $class->class_code }}</td>
                <td>
                    <a href="{{ route('students.index', ['class_id' => $class->id]) }}">
                        {{ $class->class_name }}
                    </a>
                </td>

                <td>{{ $class->department ? $class->department->name : '' }}</td>
                <td>{{ $class->academicYear ? $class->academicYear->term_name : '' }}</td>
                <td>{{ $class->status == 1 ? 'Hoạt động' : 'Không hoạt động' }}</td>

                <td>
                    <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                    <form action="{{ route('classes.destroy', $class->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $classes->links() }}
</div>
@endsection
