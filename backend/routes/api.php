<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WordController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);

Route::prefix('words')->group(function () {
    Route::get('/letters', [WordController::class, 'letters']);
    Route::post('{id}/check', [WordController::class, 'check']);
});

Route::post('/logout', [AuthController::class, 'logout']);

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');
