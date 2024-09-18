<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/siswa/showsiswa', [SertifikatController::class, 'index'])->name('siswa.showsiswa');
    Route::get('/mentor/index', [SertifikatController::class, 'index'])->name('mentor.index');

    // routes CRUD
    Route::get('/mentor', [SertifikatController::class, 'index'])->name('mentor.index');
    Route::get('/mentor/create', [SertifikatController::class, 'create'])->name('mentor.create');
    Route::post('/mentor', [SertifikatController::class, 'store'])->name('mentor.store');
    Route::get('/mentor/{sertifikat}', [SertifikatController::class, 'show'])->name('mentor.show');
    Route::get('/mentor/{sertifikat}/edit', [SertifikatController::class, 'edit'])->name('mentor.edit');
    Route::put('/mentor/{sertifikat}', [SertifikatController::class, 'update'])->name('mentor.update');
    Route::delete('/mentor/{sertifikat}', [SertifikatController::class, 'destroy'])->name('mentor.destroy');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});
