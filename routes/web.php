<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\PengajuanCutiController;
use App\Http\Controllers\LaporanController;







Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::resource('jabatan', JabatanController::class);
Route::resource('pegawai', PegawaiController::class);
// Route::get('/pegawai/{pegawai}', [PegawaiController::class, 'show'])->name('pegawai.show');


Route::resource('absensi', AbsensiController::class);
Route::get('/home', [AbsensiController::class, 'home'])->name('home');

Route::get('laporan/absensi', [LaporanController::class, 'absensi'])->name('laporan.absensi');
Route::get('/laporan/absensi/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.absensi.pdf');
Route::post('/laporan/absensi/excel', [LaporanController::class, 'exportExcel'])->name('laporan.absensi.excel');
Route::get('/cari-pegawai', [LaporanController::class, 'cariPegawai'])->name('cari.pegawai');


Route::resource('pengajuanCuti', pengajuanCutiController::class);
// Route::post('pengajuanCuti/alert', [PengajuanCutiController::class,'alert'])->name('alert');
Route::put('pengajuanCuti/{id}/approve', [PengajuanCutiController::class,'approve'])->name('pengajuanCuti.approve');
Route::put('pengajuanCuti/{id}/reject', [PengajuanCutiController::class, 'reject'])->name('pengajuanCuti.reject');
Route::get('/notifikasi-cuti', [PengajuanCutiController::class, 'getNotification']);


// use Spatie\Permission\Models\Role;
// use App\Models\User;



// Route::get('/cek-jumlah-user', function () {
//     $jumlahPegawai = User::whereHas('roles', function ($query) {
//         $query->where('name', 'user');
//     })->count();

//     return response()->json(['jumlahPegawai' => $jumlahPegawai]);
// });


// Route::get('/cek-role', function () {
//     return Role::all();
// });
