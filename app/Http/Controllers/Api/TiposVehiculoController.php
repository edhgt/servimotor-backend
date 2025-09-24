<?php

namespace App\Http\Controllers\Api;

use App\Models\TipoVehiculo;
use Illuminate\Http\Request;
use App\Http\Requests\TiposVehiculoRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\TiposVehiculoResource;

class TiposVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tiposVehiculos = TipoVehiculo::withTrashed()->orderBy('id', 'DESC')->simplePaginate($request->per_page);

        return TiposVehiculoResource::collection($tiposVehiculos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TiposVehiculoRequest $request): JsonResponse
    {
        $tiposVehiculo = TipoVehiculo::create($request->all());

        return response()->json(new TiposVehiculoResource($tiposVehiculo));
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoVehiculo $tiposVehiculo): JsonResponse
    {
        return response()->json(new TiposVehiculoResource($tiposVehiculo));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $tiposVehiculo): JsonResponse
    {
        $tiposVehiculo = TipoVehiculo::withTrashed()->findOrFail($tiposVehiculo);
        $tiposVehiculo->update($request->all());

        return response()->json(new TiposVehiculoResource($tiposVehiculo));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(TipoVehiculo $tiposVehiculo): Response
    {
        $tiposVehiculo->delete();

        return response()->noContent();
    }
}
