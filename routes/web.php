<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController; 

Route::get('/', [PageController::class,'index']);
Route::get('/about', [PageController::class,'about']);
Route::get('/service', [PageController::class,'service']);

Route::get('/schedule', [PageController::class, 'schedule']);
Route::get('/schedule-master', [PageController::class, 'schedule_master']);