<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/hello', function(Request $request) {
    return 'Hello World!';
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');