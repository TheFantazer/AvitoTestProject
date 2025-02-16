<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\MerchController;
use App\Http\Controllers\UserController;

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/coins/transfer', [CoinController::class, 'transfer']);
    Route::get('/user/profile', [UserController::class, 'profile']);
    Route::get('/merch', [MerchController::class, 'index']);
    Route::post('/merch/buy', [MerchController::class, 'buy']);
});
