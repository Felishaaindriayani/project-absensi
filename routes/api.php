<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Absensi;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
                                                    
    Route::get('/absensi', [Absensi::class, 'index']);          
    Route::post('/absensi', [Absensi::class, 'store']);          
    Route::get('/absensi/{id}', [Absensi::class, 'show']);       
    Route::put('/absensi/{id}', [Absensi::class, 'update']);     
    Route::delete('/absensi/{id}', [Absensi::class, 'destroy']); 

});
