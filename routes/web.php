<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\PengajuanCutiController;






Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::resource('jabatan', JabatanController::class);
Route::resource('pegawai', PegawaiController::class);
Route::resource('absensi', absensiController::class);
Route::resource('pengajuanCuti', pengajuanCutiController::class);


