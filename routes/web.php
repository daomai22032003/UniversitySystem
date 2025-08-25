<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ClassController;
Route::middleware('auth')->get('/', function () {
    return view('home');
});
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('home', [AuthController::class, 'home'])->name('home');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('academic_years', AcademicYearController::class);
Route::get('/index', [AcademicYearController::class, 'index']);
Route::resource('departments', DepartmentController::class);
Route::resource('classes', ClassController::class);