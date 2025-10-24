@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Điểm của sinh viên: {{ $student->name }}</h3>
    <p><strong>Mã SV:</strong> {{ $student->student_code }}</p>
    <p><strong>Lớp:</strong> {{ $student->class->name ?? 'Chưa có lớp' }}</p>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Môn học</th>
                <th>Số tín chỉ</th>
                <th>Điểm</th>
            </tr>
        </thead>
        <tbody>
            @forelse($student->grades as $grade)
                <tr>
                    <td>{{ $grade->course->course_name }}</td>
                    <td>{{ $grade->course->credit ?? 0 }}</td>
                    <td>{{ $grade->grade }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">Sinh viên này chưa có điểm.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">⬅ Quay lại</a>
</div>
@endsection
