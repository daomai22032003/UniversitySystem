<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('dashboard');

    Route::get('home', [AuthController::class, 'home'])->name('home');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('academic_years', AcademicYearController::class);
    Route::get('/index', [AcademicYearController::class, 'index']);
    Route::resource('departments', DepartmentController::class);
    Route::resource('classes', ClassController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('students', StudentController::class);
});
