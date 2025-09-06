<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes(['register' => false]);

Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth'])->where('any', '.*');
