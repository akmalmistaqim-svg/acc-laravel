<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\KabarSekitarController;
use App\Http\Controllers\RiwayatPrediksiController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminArtikelController;
use App\Http\Controllers\Admin\AdminDiagnosisController;
use App\Http\Controllers\Admin\AdminManagementController;

// ============================================
// AUTH ROUTES
// ============================================
Route::get('/', [AuthController::class, 'landing']);
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);

// ============================================
// DASHBOARD & USER FEATURES
// ============================================
Route::get('/dashboard', [AuthController::class, 'dashboard']);

Route::get('/cekpenyakit', [PenyakitController::class, 'cekPenyakit']);
Route::post('/cekpenyakit/upload', [PenyakitController::class, 'uploadFoto']);
Route::get('/infopenyakit', [PenyakitController::class, 'infoPenyakit']);
Route::get('/hasildiagnosa', [PenyakitController::class, 'hasilDiagnosa']);

// ============================================
// KABAR SEKITAR & RIWAYAT PREDIKSI
// ============================================
Route::get('/kabarsekitar', [KabarSekitarController::class, 'index'])->name('kabarsekitar.index');
Route::post('/kabarsekitar', [KabarSekitarController::class, 'store'])->name('kabarsekitar.store');
Route::get('/riwayatprediksi', [RiwayatPrediksiController::class, 'index'])->name('riwayatprediksi.index');

// ============================================
// API ROUTES
// ============================================
Route::prefix('api')->group(function () {
    Route::get('/cuaca', [DashboardController::class, 'getCuaca']);
    Route::get('/iklim', [DashboardController::class, 'getIklim']);
    Route::get('/daftar-kota', [DashboardController::class, 'getDaftarKota']);
    Route::post('/simpan-riwayat', [DashboardController::class, 'simpanRiwayat']);
});

// ============================================
// ADMIN ROUTES
// ============================================
Route::prefix('admin')->middleware(['admin.auth'])->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/logout', function() {
        Session::forget(['user', 'user_id', 'user_role', 'admin_id', 'admin_nama', 'admin_role', 'admin_username']);
        return redirect('/login')->with('success', 'Anda telah logout.');
    })->name('admin.logout');

    // DIAGNOSIS
    Route::middleware(['admin.role:superadmin,diagnosis'])->group(function () {
        Route::get('/diagnosis', [AdminDiagnosisController::class, 'index'])->name('admin.diagnosis');
        Route::get('/diagnosis/{id}/process', [AdminDiagnosisController::class, 'process'])->name('admin.diagnosis.process');
        Route::post('/diagnosis/{id}/process', [AdminDiagnosisController::class, 'processStore'])->name('admin.diagnosis.process.store');
        Route::delete('/diagnosis/{id}', [AdminDiagnosisController::class, 'destroy'])->name('admin.diagnosis.delete');
        Route::get('/diagnosis/{id}/export', [AdminDiagnosisController::class, 'export'])->name('admin.diagnosis.export');
    });

    // KELOLA PENGGUNA
    Route::middleware(['admin.role:superadmin,pengguna'])->group(function () {
        Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users');
        Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.delete');
    });

    // KELOLA ARTIKEL
    Route::middleware(['admin.role:superadmin,konten'])->group(function () {
        Route::get('/artikel', [AdminArtikelController::class, 'index'])->name('admin.artikel');
        Route::post('/artikel', [AdminArtikelController::class, 'store'])->name('admin.artikel.store');
        Route::put('/artikel/{id}', [AdminArtikelController::class, 'update'])->name('admin.artikel.update');
        Route::delete('/artikel/{id}', [AdminArtikelController::class, 'destroy'])->name('admin.artikel.delete');
    });

    // KELOLA ADMIN
    Route::middleware(['admin.role:superadmin'])->group(function () {
        Route::get('/admin-management', [AdminManagementController::class, 'index'])->name('admin.management');
        Route::post('/admin-management', [AdminManagementController::class, 'store'])->name('admin.management.store');
        Route::put('/admin-management/{id}', [AdminManagementController::class, 'update'])->name('admin.management.update');
        Route::delete('/admin-management/{id}', [AdminManagementController::class, 'destroy'])->name('admin.management.delete');
    });

}); // ⬅️ PASTIKAN TUTUP KURUNG INI ADA!