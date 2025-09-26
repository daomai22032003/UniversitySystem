<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GradeController;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::middleware('auth')->group(function () {
    Route::get('/', fn() => view('home'))->name('dashboard');
    Route::get('home', [AuthController::class, 'home'])->name('home');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::middleware('auth')->group(function () {
    Route::get('/home', [AuthController::class, 'home'])->name('home');
    Route::get('/password/change', [AuthController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/password/change', [AuthController::class, 'changePassword'])->name('password.update');
});
    Route::get('/teacher/profile', function () {
    $teacher = Auth::user()->teacher;
        return view('teachers.profile', compact('teacher'));
    })->name('teacher.profile')->middleware('auth');    
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('teachers', TeacherController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('academic_years', AcademicYearController::class);
        Route::resource('grades', GradeController::class);
    });    
    Route::middleware(['role:admin,teacher'])->group(function () {
        Route::resource('classes', ClassController::class);
        Route::resource('courses', CourseController::class);
        Route::resource('students', StudentController::class);
    });
});
