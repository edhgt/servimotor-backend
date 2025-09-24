<?php

namespace App\Http\Controllers\Api;

use App\Models\UnidadMedida;
use Illuminate\Http\Request;
use App\Http\Requests\UnidadesMedidaRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\UnidadesMedidaResource;

class UnidadesMedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $unidadesMedidas = UnidadMedida::orderBy('id', 'DESC')->simplePaginate($request->per_page);

        return UnidadesMedidaResource::collection($unidadesMedidas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UnidadesMedidaRequest $request): JsonResponse
    {
        $unidadesMedida = UnidadMedida::create($request->all());

        return response()->json(new UnidadesMedidaResource($unidadesMedida));
    }

    /**
     * Display the specified resource.
     */
    public function show(UnidadMedida $unidadesMedida): JsonResponse
    {
        return response()->json(new UnidadesMedidaResource($unidadesMedida));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UnidadMedida $unidadesMedida): JsonResponse
    {
        $unidadesMedida->update($request->all());

        return response()->json(new UnidadesMedidaResource($unidadesMedida));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(UnidadMedida $unidadesMedida): Response
    {
        $unidadesMedida->delete();

        return response()->noContent();
    }
}
