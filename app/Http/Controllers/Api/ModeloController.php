<?php

namespace App\Http\Controllers\Api;

use App\Models\Modelo;
use Illuminate\Http\Request;
use App\Http\Requests\ModeloStoreRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModeloResource;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $modelos = Modelo::withTrashed()->orderBy('id', 'DESC')->simplePaginate($request->per_page);

        return ModeloResource::collection($modelos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModeloStoreRequest $request): JsonResponse
    {
        $modelo = Modelo::create($request->all());

        return response()->json(new ModeloResource($modelo));
    }

    /**
     * Display the specified resource.
     */
    public function show(Modelo $modelo): JsonResponse
    {
        return response()->json(new ModeloResource($modelo));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $modelo): JsonResponse
    {
        $modelo = Modelo::withTrashed()->findOrFail($modelo);
        $modelo->update($request->all());

        return response()->json(new ModeloResource($modelo));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Modelo $modelo): Response
    {
        $modelo->delete();

        return response()->noContent();
    }
}
