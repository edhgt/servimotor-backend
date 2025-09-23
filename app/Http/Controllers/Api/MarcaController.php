<?php

namespace App\Http\Controllers\Api;

use App\Models\Marca;
use Illuminate\Http\Request;
use App\Http\Requests\MarcaRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\MarcaResource;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $marcas = Marca::orderBy('id', 'DESC')->simplePaginate($request->per_page);

        return MarcaResource::collection($marcas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MarcaRequest $request): JsonResponse
    {
        $marca = Marca::create($request->validated());

        return response()->json(new MarcaResource($marca));
    }

    /**
     * Display the specified resource.
     */
    public function show(Marca $marca): JsonResponse
    {
        return response()->json(new MarcaResource($marca));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MarcaRequest $request, Marca $marca): JsonResponse
    {
        $marca->update($request->validated());

        return response()->json(new MarcaResource($marca));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Marca $marca): Response
    {
        $marca->delete();

        return response()->noContent();
    }
}
