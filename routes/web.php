<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthCOntroller::class, 'registeration'])->name('registeration');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'log_in'])->name('log_in');

Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
