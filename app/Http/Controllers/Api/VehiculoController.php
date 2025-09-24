<?php

namespace App\Http\Controllers\Api;

use App\Models\Vehiculo;
use Illuminate\Http\Request;
use App\Http\Requests\VehiculoStoreRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\VehiculoResource;
use App\Models\Cliente;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $cliente)
    {
        $vehiculos = Vehiculo::withTrashed()
            ->with([
                'marca:id,nombre',
                'modelo:id,nombre',
                'color:id,nombre',
                'tipoVehiculo:id,nombre',
                'tipoMotor:id,nombre',
                'tipoTransmision:id,nombre',
            ])
            ->orderBy('id', 'DESC')
            ->where('cliente_id', $cliente)
            ->simplePaginate($request->per_page);

        return VehiculoResource::collection($vehiculos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehiculoStoreRequest $request, $cliente): JsonResponse
    {
        $vehiculo = Vehiculo::create($request->all());

        return response()->json(new VehiculoResource($vehiculo));
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehiculo $vehiculo): JsonResponse
    {
        return response()->json(new VehiculoResource($vehiculo));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $vehiculo): JsonResponse
    {
        $vehiculo = Vehiculo::withTrashed()->findOrFail($vehiculo);
        $vehiculo->update($request->all());

        return response()->json(new VehiculoResource($vehiculo));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Vehiculo $vehiculo): Response
    {
        $vehiculo->delete();

        return response()->noContent();
    }
}
