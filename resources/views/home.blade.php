@extends('layouts.app')

@section('title')
    <title>Trang chủ</title>
@endsection

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="mb-0">Trang chủ</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-3">
        @php
            $role = Auth::user()->role;
        @endphp

        @if ($role === 'admin')
            {{-- ADMIN DASHBOARD --}}
           <div class="container mt-4">
    <h3 class="fw-bold mb-4 text-primary">Bảng điều khiển quản trị</h3>

    <div class="row g-4">
        @php
            $cards = [
                ['title' => 'Giáo viên', 'count' => \App\Models\Teacher::count(), 'route' => 'teachers.index', 'icon' => 'bi-person-badge-fill', 'color' => 'linear-gradient(135deg, #6a11cb 0%, #2575fc 100%)', 'btn' => 'Quản lý'],
                ['title' => 'Sinh viên', 'count' => \App\Models\Student::count(), 'route' => 'students.index', 'icon' => 'bi-people-fill', 'color' => 'linear-gradient(135deg, #00b09b 0%, #96c93d 100%)', 'btn' => 'Quản lý'],
                ['title' => 'Lớp học',  'count' => \App\Models\ClassModel::count(), 'route' => 'classes.index', 'icon' => 'bi-journal-bookmark-fill', 'color' => 'linear-gradient(135deg, #ff512f 0%, #dd2476 100%)', 'btn' => 'Xem'],
                ['title' => 'Môn học',  'count' => \App\Models\Course::count(), 'route' => 'courses.index', 'icon' => 'bi-book-fill', 'color' => 'linear-gradient(135deg, #f7971e 0%, #ffd200 100%)', 'btn' => 'Xem'],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="col-md-3 col-sm-6">
                <div class="card text-center border-0 shadow-sm rounded-4 hover-card"
                     style="background: {{ $card['color'] }}; color: white; height: 200px; display: flex; align-items: center; justify-content: center;">
                    <div>
                        <i class="bi {{ $card['icon'] }} fs-1 mb-2 d-block"></i>
                        <h5 class="fw-semibold mb-1">{{ $card['title'] }}</h5>
                        <p class="fw-bold fs-2 mb-2">{{ $card['count'] }}</p>
                        <a href="{{ route($card['route']) }}" class="btn btn-light btn-sm fw-semibold shadow-sm">
                            {{ $card['btn'] }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
  </div>
        <style>
        .hover-card {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .hover-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.25);
        }
        </style>
        @elseif ($role === 'teacher')
            {{-- GIÁO VIÊN DASHBOARD --}}
           <div class="container mt-4">
    <h4 class="fw-bold text-primary mb-4">Bảng điều khiển giảng viên</h4>

    <div class="row g-4">
        @php
            $teacher = Auth::user()->teacher;
            $cards = [
                [
                    'title' => 'Lớp học của tôi',
                    'count' => \App\Models\ClassModel::where('teacher_id', $teacher->id)->count(),
                    'route' => 'classes.index',
                    'icon' => 'fas fa-chalkboard',
                    'color' => 'linear-gradient(135deg, #667eea, #764ba2)',
                    'btn' => 'Xem'
                ],
                [
                    'title' => 'Sinh viên của tôi',
                    'count' => \App\Models\Student::whereHas('class', fn($q) => $q->where('teacher_id', $teacher->id))->count(),
                    'route' => 'students.index',
                    'icon' => 'fas fa-users',
                    'color' => 'linear-gradient(135deg, #00b09b, #96c93d)',
                    'btn' => 'Danh sách'
                ],
                [
                    'title' => 'Điểm sinh viên',
                    'count' => \App\Models\Grade::count(),
                    'route' => 'grades.index',
                    'icon' => 'fas fa-clipboard-list',
                    'color' => 'linear-gradient(135deg, #f7971e, #ffd200)',
                    'btn' => 'Nhập điểm'
                ],
                [
                    'title' => 'Hồ sơ cá nhân',
                    'count' => '👤',
                    'route' => 'teacher.profile',
                    'icon' => 'fas fa-user-circle',
                    'color' => 'linear-gradient(135deg, #36d1dc, #5b86e5)',
                    'btn' => 'Cập nhật'
                ],
            ];
        @endphp

        @foreach ($cards as $card)
        <div class="col-md-3 col-sm-6">
            <div class="card text-center text-white border-0 shadow-sm rounded-4 hover-card"
                 style="background: {{ $card['color'] }};">
                <div class="card-body py-4">
                    <i class="{{ $card['icon'] }} fa-2x mb-2"></i>
                    <h6 class="mb-1">{{ $card['title'] }}</h6>
                    <h3 class="fw-bold mb-2">{{ $card['count'] }}</h3>
                    <a href="{{ route($card['route']) }}" class="btn btn-light btn-sm fw-semibold">
                        {{ $card['btn'] }}
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
 </div>

        @elseif ($role === 'student')
            {{--SINH VIÊN DASHBOARD --}}
           <div class="container mt-4">
    <h4 class="fw-bold text-primary mb-4">Bảng điều khiển sinh viên</h4>

    <div class="row g-4">
        {{-- Hồ sơ cá nhân --}}
        <div class="col-md-3 col-sm-6">
            <div class="card text-center text-white border-0 shadow-sm rounded-4" 
                 style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                <div class="card-body py-4">
                    <i class="fas fa-user-graduate fa-2x mb-2"></i>
                    <h6>Hồ sơ cá nhân</h6>
                    <h3 class="fw-bold">👤</h3>
                    <a href="{{ route('student.profile') }}" class="btn btn-light btn-sm mt-2">Xem</a>
                </div>
            </div>
        </div>

        {{-- Bảng điểm --}}
        <div class="col-md-3 col-sm-6">
            <div class="card text-center text-white border-0 shadow-sm rounded-4" 
                 style="background: linear-gradient(135deg, #00b09b, #96c93d);">
                <div class="card-body py-4">
                    <i class="fas fa-clipboard-list fa-2x mb-2"></i>
                    <h6>Bảng điểm</h6>
                    <h3 class="fw-bold">
                        {{ \App\Models\Grade::where('student_id', Auth::user()->student->id)->count() }}
                    </h3>
                    <a href="{{ route('student.grades') }}" class="btn btn-light btn-sm mt-2">Xem</a>
                </div>
            </div>
        </div>

        {{-- Lớp học --}}
        <div class="col-md-3 col-sm-6">
            <div class="card text-center text-white border-0 shadow-sm rounded-4" 
                 style="background: linear-gradient(135deg, #f85032, #e73827);">
                <div class="card-body py-4">
                    <i class="fas fa-chalkboard-teacher fa-2x mb-2"></i>
                    <h6>Lớp học</h6>
                    <h3 class="fw-bold">
                        {{ optional(Auth::user()->student->class)->class_name ?? '—' }}
                    </h3>
                    <a href="{{ route('classes.index') }}" class="btn btn-light btn-sm mt-2">Xem</a>
                </div>
            </div>
        </div>

        {{-- Tin tức --}}
        <div class="col-md-3 col-sm-6">
            <div class="card text-center text-white border-0 shadow-sm rounded-4" 
                 style="background: linear-gradient(135deg, #f7971e, #ffd200);">
                <div class="card-body py-4">
                    <i class="fas fa-newspaper fa-2x mb-2"></i>
                    <h6>Tin tức mới</h6>
                    <h3 class="fw-bold">📰</h3>
                    <a href="{{ route('news.index') }}" class="btn btn-light btn-sm mt-2">Xem</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card:hover {
    transform: translateY(-5px);
    transition: 0.3s ease;
}
</style>


        @else
            <div class="alert alert-warning">
                Không xác định vai trò người dùng.
            </div>
        @endif
    </div>
</main>
@endsection
