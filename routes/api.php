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

	Route::apiResource('categorias', Api\CategoriaController::class);
	Route::apiResource('colores', Api\ColorController::class);
	Route::apiResource('marcas', Api\MarcaController::class);
	Route::apiResource('modelos', Api\ModeloController::class);
	Route::apiResource('estados', Api\EstadoController::class);
	Route::apiResource('puestos', Api\PuestoController::class);
	Route::apiResource('tipos-vehiculo', Api\TiposVehiculoController::class);
	Route::apiResource('tipos-motor', Api\TiposMotorController::class);
	Route::apiResource('tipos-transmision', Api\TiposTransmisionController::class);
	Route::apiResource('unidades-medida', Api\UnidadesMedidaController::class);
	Route::apiResource('formas-pago', Api\FormasPagoController::class);
	Route::apiResource('tipos-documento', Api\TiposDocumentoController::class);

	Route::apiResource('clientes', Api\ClienteController::class);
	Route::apiResource('vehiculos', Api\VehiculoController::class);

	Route::get('bitacora', App\Http\Controllers\Api\BitacoraController::class);
	Route::get('exportar-bitacora', [App\Http\Controllers\Api\BitacoraController::class, 'export'])->name('exportar.bitacora');
});

