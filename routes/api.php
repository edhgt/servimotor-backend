<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

//Route::post('login', [App\Http\Controllers\Api\Auth\LoginController::class, 'login'])->name('login');

Route::prefix('v1')->middleware('auth:api')->group(function() {
    Route::get('me', [App\Http\Controllers\Api\Auth\LoginController::class, 'me'])->name('me');

    Route::apiResource('users', App\Http\Controllers\Api\UserController::class);
});
