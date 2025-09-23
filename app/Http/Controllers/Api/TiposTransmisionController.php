<?php

namespace App\Http\Controllers\Api;

use App\Models\TipoTransmision;
use Illuminate\Http\Request;
use App\Http\Requests\TiposTransmisionRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\TiposTransmisionResource;

class TiposTransmisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tiposTransmisions = TipoTransmision::orderBy('id', 'DESC')->simplePaginate($request->per_page);

        return TiposTransmisionResource::collection($tiposTransmisions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TiposTransmisionRequest $request): JsonResponse
    {
        $tiposTransmision = TipoTransmision::create($request->validated());

        return response()->json(new TiposTransmisionResource($tiposTransmision));
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoTransmision $tiposTransmision): JsonResponse
    {
        return response()->json(new TiposTransmisionResource($tiposTransmision));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TiposTransmisionRequest $request, TipoTransmision $tiposTransmision): JsonResponse
    {
        $tiposTransmision->update($request->validated());

        return response()->json(new TiposTransmisionResource($tiposTransmision));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(TiposTransmision $tiposTransmision): Response
    {
        $tiposTransmision->delete();

        return response()->noContent();
    }
}
