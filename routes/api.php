<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
	Route::get('/user', function (Request $request) {
		$user = auth()->user();
		
		if($user->hasRole('Super Admin')) {
			$user['permissions'] = \Spatie\Permission\Models\Permission::all();
		} else {
			$user['permissions'] = $user->getPermissionsViaRoles();
		}
	
		return $user;
	})->name('user');

	Route::apiResource('users', App\Http\Controllers\Api\UserController::class);

});

