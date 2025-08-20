<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
Route::middleware('auth')->get('/', function () {
    return view('index');
});
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('index', [AuthController::class, 'index'])->name('index');
Route::get('sidebar', [AuthController::class, 'sidebar'])->name('sidebar');