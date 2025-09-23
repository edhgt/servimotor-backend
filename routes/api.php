<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;


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

	Route::apiResource('users', Api\UserController::class);
	Route::apiResource('permissions', Api\PermissionController::class);
	Route::apiResource('roles', Api\RoleController::class);
	Route::apiResource('puestos', Api\PuestoController::class);

	Route::get('bitacora', App\Http\Controllers\Api\BitacoraController::class);
	Route::get('exportar-bitacora', [App\Http\Controllers\Api\BitacoraController::class, 'export'])->name('exportar.bitacora');
});

