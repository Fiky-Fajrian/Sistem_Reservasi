<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PropertiController;
use App\Http\Controllers\ReservasiController;
use Illuminate\Support\Facades\Route;

// Halaman utama: Landing Page
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Autentikasi: login & pendaftaran dengan pilihan role
Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/daftar', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/daftar', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Reservasi: wajib login dan khusus role penyewa
Route::middleware(['auth', 'role.penyewa'])->group(function (): void {
    Route::get('/reservasi', [ReservasiController::class, 'index'])->name('reservasi.index');
    Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');
});

// Fitur Chat & Keluhan Penyewa ke Pengelola Kos
Route::post('/keluhan', [MessageController::class, 'store'])->name('keluhan.store');
Route::put('/keluhan/{message}', [MessageController::class, 'update'])->name('keluhan.update');

// Dashboard pemilik kos
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Manajemen Properti & Kamar (sesuai mockup)
Route::get('/properti', [PropertiController::class, 'index'])
    ->name('properti.index');
