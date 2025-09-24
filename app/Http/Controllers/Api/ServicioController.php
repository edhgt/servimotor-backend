<?php

namespace App\Http\Controllers\Api;

use App\Models\Servicio;
use Illuminate\Http\Request;
use App\Http\Requests\ServicioStoreRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServicioResource;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $servicios = Servicio::orderBy('id', 'DESC')->simplePaginate($request->per_page);

        return ServicioResource::collection($servicios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServicioStoreRequest $request): JsonResponse
    {
        $servicio = Servicio::create($request->all());

        return response()->json(new ServicioResource($servicio));
    }

    /**
     * Display the specified resource.
     */
    public function show(Servicio $servicio): JsonResponse
    {
        return response()->json(new ServicioResource($servicio));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servicio $servicio): JsonResponse
    {
        $servicio->update($request->all());

        return response()->json(new ServicioResource($servicio));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Servicio $servicio): Response
    {
        $servicio->delete();

        return response()->noContent();
    }
}
