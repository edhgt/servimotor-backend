<?php

namespace App\Http\Controllers\Api;

use App\Models\Estado;
use Illuminate\Http\Request;
use App\Http\Requests\EstadoStoreRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\EstadoResource;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $estados = Estado::withTrashed()->orderBy('id', 'DESC')->simplePaginate($request->per_page);

        return EstadoResource::collection($estados);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EstadoStoreRequest $request): JsonResponse
    {
        $estado = Estado::create($request->all());

        return response()->json(new EstadoResource($estado));
    }

    /**
     * Display the specified resource.
     */
    public function show(Estado $estado): JsonResponse
    {
        return response()->json(new EstadoResource($estado));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $estado): JsonResponse
    {
        $estado = Estado::withTrashed()->findOrFail($estado);
        $estado->update($request->all());

        return response()->json(new EstadoResource($estado));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Estado $estado): Response
    {
        $estado->delete();

        return response()->noContent();
    }
}
