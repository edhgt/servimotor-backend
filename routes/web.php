<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'index'])->where('any', '.*');
