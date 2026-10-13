<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KosController;
use App\Http\Controllers\Api\ReservasiController;

Route::get('/kos', [KosController::class, 'index']);
Route::get('/kos/{id}', [KosController::class, 'show']);

Route::post('/reservasi', [ReservasiController::class, 'store']);
Route::put('/reservasi/{id}', [ReservasiController::class, 'update']);