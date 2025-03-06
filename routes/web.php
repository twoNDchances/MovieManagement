<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest.custom'])->group(function () {
    Route::get('/login', [LoginController::class, 'getLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'postLogin']);
});

Route::middleware(['auth.custom'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'getDashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class,'getProfile'])->name('profile');
    Route::get('/logout', [LoginController::class, 'getLogout'])->name('logout');
});
