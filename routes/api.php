<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::prefix('v1')->group(function() {
    Route::post('login', [App\Http\Controllers\Api\Auth\LoginController::class, 'login'])->name('login');
    Route::get('me', [App\Http\Controllers\Api\Auth\LoginController::class, 'me'])->name('me');
});
