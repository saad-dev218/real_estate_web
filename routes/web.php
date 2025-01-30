<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthCOntroller::class, 'registeration'])->name('registeration');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'log_in'])->name('log_in');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('listings', ListingController::class);
