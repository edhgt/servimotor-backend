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
    public function index(Request $request)
    {
        $vehiculos = Vehiculo::orderBy('id', 'DESC')->simplePaginate($request->per_page);

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
    public function update(Request $request, Vehiculo $vehiculo): JsonResponse
    {
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
