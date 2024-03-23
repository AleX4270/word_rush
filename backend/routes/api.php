<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordController;

Route::prefix('words')->group(function () {
    Route::get('/letters', [WordController::class, 'letters']);
    Route::post('{id}/check', [WordController::class, 'check']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
