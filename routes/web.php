<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenyakitController;

// Auth routes
Route::get('/', [AuthController::class, 'landing']);
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);

// Halaman Penyakit
Route::get('/cekpenyakit', [PenyakitController::class, 'cekPenyakit']);
Route::get('/infopenyakit', [PenyakitController::class, 'infoPenyakit']);
Route::get('/hasildiagnosa', [PenyakitController::class, 'hasilDiagnosa']);

// API Routes
Route::prefix('api')->group(function () {
    Route::get('/cuaca', [DashboardController::class, 'getCuaca']);
    Route::get('/iklim', [DashboardController::class, 'getIklim']);
    Route::get('/daftar-kota', [DashboardController::class, 'getDaftarKota']);
});