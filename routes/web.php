<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/siswa/dashboard', [SertifikatController::class, 'index'])->name('siswa.dashboard');
    Route::get('/siswa/nilai/{id_sertifikat}', [PenilaianController::class, 'showNilai'])->name('siswa.nilai');
    Route::get('/mentor/dashboard', [SertifikatController::class, 'dashboard'])->name('mentor.dashboard');

    // routes CRUD
    Route::get('/mentor', [SertifikatController::class, 'index'])->name('mentor.index');
    // Route::get('/mentor/dashboard', [SertifikatController::class, 'index'])->name('mentor.dashboard');
    Route::get('/mentor/create', [SertifikatController::class, 'create'])->name('mentor.create');
    Route::post('/mentor', [SertifikatController::class, 'store'])->name('mentor.store');
    Route::get('/mentor/{sertifikat}', [SertifikatController::class, 'show'])->name('mentor.show');
    Route::get('/mentor/{sertifikat}/edit', [SertifikatController::class, 'edit'])->name('mentor.edit');
    Route::get('/sertifikat/{sertifikat}/cetak', [SertifikatController::class, 'cetak'])->name('sertifikat.cetak');
    Route::get('/mentor/cetak-pdf/{sertifikat}', [SertifikatController::class, 'cetakPDF'])->name('mentor.cetak-pdf');
    Route::put('/mentor/{sertifikat}', [SertifikatController::class, 'update'])->name('mentor.update');
    Route::delete('/mentor/{sertifikat}', [SertifikatController::class, 'destroy'])->name('mentor.destroy');

    Route::get('/sertifikat/{sertifikat}/cetak-gabungan', [SertifikatController::class, 'cetakGabung'])->name('sertifikat.cetak-gabungan');


    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id_sertifikat}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id_sertifikat}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id_sertifikat}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::get('/penilaian/create', [PenilaianController::class, 'create'])->name('penilaian.create');
    Route::post('/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');
    Route::get('/penilaian/cetak/{id_sertifikat}', [PenilaianController::class, 'cetak'])->name('penilaian.cetak');
    Route::get('/export-pdf/{id_sertifikat}', [PenilaianController::class, 'exportToPDF'])->name('export.pdf');
    Route::get('/penilaian/{penilaian}/edit', [PenilaianController::class, 'edit'])->name('penilaian.edit');
    Route::put('/penilaian/{penilaian}', [PenilaianController::class, 'update'])->name('penilaian.update');
    Route::delete('/penilaian/{penilaian}', [PenilaianController::class, 'destroy'])->name('penilaian.destroy');
});
