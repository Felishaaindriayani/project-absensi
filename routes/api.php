<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Absensi;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\API\PengajuanCutiController;




Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

    Route::get('/absensi', [Absensi::class, 'index']);
    Route::post('/absensi', [Absensi::class, 'store']);
    Route::get('/absensi/{id}', [Absensi::class, 'show']);
    Route::put('/absensi/{id}', [Absensi::class, 'update']);
    Route::delete('/absensi/{id}', [Absensi::class, 'destroy']);

    Route::get('/profile', [ProfileController::class, 'getProfile']);

    // 🔽 Route pengajuan cuti
    Route::get('/pengajuancuti', [PengajuanCutiController::class, 'index']);
    Route::post('/pengajuancuti', [PengajuanCutiController::class, 'store']);
    Route::get('/pengajuancuti/{id}', [PengajuanCutiController::class, 'show']);
});



