<?php
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\DiagnosisController;

Route::post('/register', [ApiAuthController::class, 'register']);
Route::post('/login', [ApiAuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('diagnosis', DiagnosisController::class);
});