@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary mb-0">🎓 Bảng điểm của tôi</h2>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">
            ⬅ Trở về trang chủ
        </a>
    </div>

    {{-- Bộ lọc năm học --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('student.grades') }}" class="row g-3 align-items-center">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Năm học</label>
                    <select name="academic_year_id" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Tất cả năm học --</option>
                        @foreach($academicYears as $year)
                            <option value="{{ $year->id }}" {{ request('academic_year_id') == $year->id ? 'selected' : '' }}>
                                {{ $year->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    {{-- Bảng điểm --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="fw-semibold mb-3">📚 Danh sách môn học</h5>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-primary text-center">
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
                                <td class="fw-semibold">{{ $grade->course->course_name }}</td>
                                <td class="text-center">{{ $grade->course->credit }}</td>
                                <td class="text-center">{{ $grade->academicYear->term_name }}</td>
                                <td class="text-center">
                                    <span class="badge 
                                        @if($grade->grade >= 8) bg-success
                                        @elseif($grade->grade >= 6.5) bg-info
                                        @elseif($grade->grade >= 5) bg-warning text-dark
                                        @else bg-danger
                                        @endif
                                    ">
                                        {{ number_format($grade->grade, 2) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Không có dữ liệu điểm 😢
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- GPA --}}
    <div class="card shadow-sm border-0 mt-4">
        <div class="card-body">
            <h5 class="fw-semibold mb-3">📊 Thống kê GPA</h5>

            <ul class="list-group mb-3">
                @forelse ($gpaByYear as $yearId => $gpa)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $academicYears->find($yearId)->term_name ?? 'Không xác định' }}
                        <span class="badge bg-primary rounded-pill">{{ number_format($gpa, 2) }}</span>
                    </li>
                @empty
                    <li class="list-group-item text-muted">Chưa có dữ liệu GPA theo năm học.</li>
                @endforelse
            </ul>

            <div class="alert alert-success text-center fw-semibold fs-5">
                🎯 GPA toàn khóa: <strong>{{ number_format($overallGPA, 2) }}</strong>
            </div>
        </div>
    </div>

</div>
@endsection
