@extends('layouts.app')

@section('content')
<div class="container">
    <h2>🎓 Điểm của tôi</h2>

    {{-- Bộ lọc năm học --}}
    <form method="GET" action="{{ route('student.grades') }}" class="mb-3">
        <div class="row g-2">
            <div class="col-md-4">
                <select name="academic_year_id" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Tất cả năm học --</option>
                    @foreach($academicYears as $year)
                        <option value="{{ $year->id }}" {{ request('academic_year_id') == $year->id ? 'selected' : '' }}>
                            {{ $year->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    {{-- Danh sách điểm --}}
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Môn học</th>
                <th>Tín chỉ</th>
                <th>Năm học</th>
                <th>Điểm</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($grades as $grade)
                <tr>
                    <td>{{ $grade->course->course_name }}</td>
                    <td>{{ $grade->course->credit }}</td>
                    <td>{{ $grade->academicYear->term_name }}</td>
                    <td>{{ $grade->grade }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Không có dữ liệu điểm</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- GPA --}}
    <div class="mt-4">
        <h5>📊 GPA theo từng năm học:</h5>
        <ul>
            @foreach ($gpaByYear as $yearId => $gpa)
                <li>{{ $academicYears->find($yearId)->term_name ?? 'Không xác định' }}: <strong>{{ $gpa }}</strong></li>
            @endforeach
        </ul>

        <h5>🎯 GPA toàn khóa: <strong>{{ $overallGPA }}</strong></h5>
    </div>
</div>
@endsection
