@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Danh sách điểm</h2>
    <a href="{{ route('grades.create') }}" class="btn btn-primary mb-3">+ Thêm điểm</a>

    {{-- Form lọc lớp --}}
    <form method="GET" action="{{ route('grades.index') }}" class="mb-3">
        <div class="row g-2">
            <div class="col-md-4">
                <select name="class_id" class="form-select">
                    <option value="">-- Tất cả lớp --</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}"
                            {{ request('class_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->class_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-success">Lọc</button>
            </div>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @foreach($gradesByClass as $className => $grades)
        <h4 class="mt-4">Lớp: {{ $className }}</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã SV</th>
                    <th>Tên SV</th>
                    <th>Môn học</th>
                    <th>Kỳ học</th>
                    <th>Điểm</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grades as $grade)
                    <tr>
                        <td>{{ $grade->student->student_code }}</td>
                        <td>{{ $grade->student->name }}</td>
                        <td>{{ $grade->course->course_name }}</td>
                        <td>{{ $grade->academicYear->term_name }}</td>
                        <td>{{ $grade->grade }}</td>
                        <td>
                            <a href="{{ route('grades.edit', $grade->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('grades.destroy', $grade->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</div>
@endsection
