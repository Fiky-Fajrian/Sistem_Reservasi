<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BillingMeteranController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PropertiController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\PenghuniController;
use Illuminate\Support\Facades\Route;

// Landing page
Route::get('/', [LandingController::class, 'index'])
    ->name('landing');

// Login dan registrasi
Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.attempt');

    Route::get('/daftar', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/daftar', [AuthController::class, 'register'])
        ->name('register.store');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Fitur penyewa
Route::middleware(['auth', 'role.penyewa'])->group(function (): void {
    Route::get('/reservasi', [ReservasiController::class, 'index'])
        ->name('reservasi.index');

    Route::post('/reservasi', [ReservasiController::class, 'store'])
        ->name('reservasi.store');

    Route::post('/keluhan', [MessageController::class, 'store'])
        ->name('keluhan.store');
});

// Fitur pengelola kos dan admin
Route::middleware(['auth', 'role.pengelola'])->group(function (): void {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/properti', [PropertiController::class, 'index'])
        ->name('properti.index');
});

    Route::put('/keluhan/{message}', [MessageController::class, 'update'])
        ->name('keluhan.update');

// Manajemen Properti & Kamar (sesuai mockup)
Route::get('/properti', [PropertiController::class, 'index'])
    ->name('properti.index');
Route::get('/manajemen-kamar', [PropertiController::class, 'index'])
    ->name('kamar.index');

// Tagihan, pembayaran, dan monitoring meteran listrik/air
Route::get('/tagihan-pembayaran', [BillingMeteranController::class, 'index'])->name('tagihan.index');
Route::get('/meteran', [BillingMeteranController::class, 'index'])->name('meteran.index');

// Manajemen Data Penghuni
Route::middleware('auth')->group(function () {
    Route::get('/penghuni', [PenghuniController::class, 'index'])
        ->name('penghuni.index');

    Route::post('/penghuni', [PenghuniController::class, 'store'])
        ->name('penghuni.store');

    Route::put('/penghuni/{id}', [PenghuniController::class, 'update'])
        ->name('penghuni.update');

    Route::delete('/penghuni/{id}', [PenghuniController::class, 'destroy'])
        ->name('penghuni.destroy');
});