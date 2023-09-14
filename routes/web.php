<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SahabatBcController;
use App\Http\Controllers\DaftarController;

Route::get('/', [SahabatBcController::class, 'index']);

Route::get('/kegiatan', function () {
    return view('gallery');
});

Route::get('/daftar', [DaftarController::class, 'index']);
Route::post('/daftar/insert', [DaftarController::class, 'insertData'])->name('daftar.insert');
Route::get('/daftar/detail/{arr}', [DaftarController::class, 'detail'])->name('daftar.detail');

Route::post('/cariData', [DaftarController::class, 'cariData'])->name('cariData');

Route::get('/download/{id}/{type}', [DaftarController::class, 'download'])->name('download');
// // Contoh rute untuk mengunduh berkas dari database
Route::get('/download/{id}/berkas_toter', [DaftarController::class, 'downloadBerkasToter']);


Route::get('/home', function () {
    return redirect('admin');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/log', [LoginController::class, 'index'])->name('login');
    Route::post('/log', [LoginController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/operator', [AdminController::class, 'operator'])->middleware('userAkses:operator');
    Route::get('/admin/panitia', [AdminController::class, 'panitia'])->middleware('userAkses:panitia');
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/downloads/{id}/{type}', [AdminController::class, 'download'])->name('downloads');
    Route::get('/unduh-proposal/{id}', [AdminController::class, 'unduhProposal'])->name('unduh.proposal');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('edit');
    Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('update');
});
