<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\ProductController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/auth', [AuthController::class, 'login']);

//with jwt
Route::middleware('auth:api')->group(function () {

    Route::get('/info', [InfoController::class, 'info']);

    Route::post('/sendCoin', [CoinController::class, 'sendCoin']);

    Route::get('/buy/{item}', [ProductController::class, 'buy']);
});
