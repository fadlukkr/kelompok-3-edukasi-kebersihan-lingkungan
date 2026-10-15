<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EdukasiController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

// ---------- Authentication ----------
Route::middleware('guest:web,admin')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:web,admin')
    ->name('logout');

// ---------- Dashboard Masyarakat (UC-04 s/d UC-08) ----------
Route::middleware('auth:web')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/kuis', [DashboardController::class, 'submitKuis'])->name('dashboard.kuis.submit');
    Route::post('/dashboard/laporan', [DashboardController::class, 'storeLaporan'])->name('dashboard.laporan.store');
    Route::post('/dashboard/feedback', [DashboardController::class, 'storeFeedback'])->name('dashboard.feedback.store');
});

// ---------- Dashboard Admin (UC-09 s/d UC-12) ----------
Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::post('/materi', [AdminDashboardController::class, 'saveMateri'])->name('materi.save');
    Route::delete('/materi/{edukasi}', [AdminDashboardController::class, 'destroyMateri'])->name('materi.destroy');
    Route::post('/kuis', [AdminDashboardController::class, 'storeKuis'])->name('kuis.store');
    Route::delete('/kuis/{soal}', [AdminDashboardController::class, 'destroyKuis'])->name('kuis.destroy');
    Route::patch('/laporan/{laporan}/status', [AdminDashboardController::class, 'updateLaporanStatus'])->name('laporan.status');
    Route::delete('/laporan/{laporan}', [AdminDashboardController::class, 'destroyLaporan'])->name('laporan.destroy');
});

// ---------- Materi Edukasi (khusus admin) ----------
Route::resource('edukasi', EdukasiController::class)->middleware('auth:admin');
Route::redirect('/materi', '/edukasi');
