<?php

namespace App\Http\Controllers\Api;

use App\Models\Puesto;
use Illuminate\Http\Request;
use App\Http\Requests\PuestoRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\PuestoResource;

class PuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $puestos = Puesto::simplePaginate();

        return PuestoResource::collection($puestos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PuestoRequest $request): JsonResponse
    {
        $puesto = Puesto::create($request->validated());

        return response()->json(new PuestoResource($puesto));
    }

    /**
     * Display the specified resource.
     */
    public function show(Puesto $puesto): JsonResponse
    {
        return response()->json(new PuestoResource($puesto));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PuestoRequest $request, Puesto $puesto): JsonResponse
    {
        $puesto->update($request->validated());

        return response()->json(new PuestoResource($puesto));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Puesto $puesto): Response
    {
        $puesto->delete();

        return response()->noContent();
    }
}
