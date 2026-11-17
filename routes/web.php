<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Halaman utama: Landing Page
Route::view('/', 'landing')->name('landing');

// Dashboard pemilik kos
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
