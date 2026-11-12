<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Models\Edukasi;
use App\Http\Controllers\EdukasiController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth');
Route::post('/edukasi', [EdukasiController::class, 'storeApi']);


Route::get('/edukasi', function () {
    return response()->json([
        'status' => 'success',
        'data' => Edukasi::all()
    ], 200);
});