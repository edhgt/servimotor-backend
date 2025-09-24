<?php

namespace App\Http\Controllers\Api;

use App\Models\TipoDocumento;
use Illuminate\Http\Request;
use App\Http\Requests\TiposDocumentoRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\TiposDocumentoResource;

class TiposDocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tiposDocumentos = TipoDocumento::orderBy('id', 'DESC')->simplePaginate($request->per_page);

        return TiposDocumentoResource::collection($tiposDocumentos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TiposDocumentoRequest $request): JsonResponse
    {
        $tiposDocumento = TipoDocumento::create($request->all());

        return response()->json(new TiposDocumentoResource($tiposDocumento));
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoDocumento $tiposDocumento): JsonResponse
    {
        return response()->json(new TiposDocumentoResource($tiposDocumento));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoDocumento $tiposDocumento): JsonResponse
    {
        $tiposDocumento->update($request->all());

        return response()->json(new TiposDocumentoResource($tiposDocumento));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(TipoDocumento $tiposDocumento): Response
    {
        $tiposDocumento->delete();

        return response()->noContent();
    }
}
