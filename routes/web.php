<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentGradeController;
use App\Http\Controllers\NewsController;

// ================= AUTH =================
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('postLogin');

// ================= PROTECTED ROUTES =================
Route::middleware(['auth'])->group(function () {

    // --- Trang chủ & logout ---
    Route::get('/', fn() => view('home'))->name('dashboard');
    Route::get('/home', [AuthController::class, 'home'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- Đổi mật khẩu ---
    Route::get('/password/change', [AuthController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/password/change', [AuthController::class, 'changePassword'])->name('password.update');

    // --- Giáo viên ---
    Route::get('/teacher/profile', function () {
        $teacher = Auth::user()->teacher;
        return view('teachers.profile', compact('teacher'));
    })->name('teacher.profile');

    // --- Sinh viên ---
    Route::get('/student/profile', [StudentController::class, 'profile'])->name('student.profile');
    Route::get('/student/grades', [StudentGradeController::class, 'index'])->name('student.grades');
    Route::get('/student/classmates', [StudentController::class, 'classmates'])->name('student.classmates'); // ✅ danh sách sinh viên cùng lớp

    // --- Tin tức ---
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

    // --- Admin ---
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('teachers', TeacherController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('academic_years', AcademicYearController::class);
    });

    // --- Tất cả role đều có thể xem danh sách lớp ---
    Route::get('/classes', [ClassController::class, 'index'])->name('classes.index');
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    // --- Admin hoặc Giáo viên ---
    Route::middleware(['role:admin,teacher'])->group(function () {
        Route::resource('classes', ClassController::class)->except(['index']);
        Route::resource('courses', CourseController::class);
        Route::resource('students', StudentController::class)->except(['index']);
        Route::resource('grades', GradeController::class);

        // Xem điểm sinh viên theo giáo viên
        Route::get('/teacher/student/{id}/scores', [GradeController::class, 'showByStudent'])
            ->name('teacher.student.scores');
    });
   
});
