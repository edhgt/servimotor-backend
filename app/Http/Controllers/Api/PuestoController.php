<?php

namespace App\Http\Controllers\Api;

use App\Models\Puesto;
use Illuminate\Http\Request;
use App\Http\Requests\PuestoStoreRequest;
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
        $puestos = Puesto::withTrashed()->orderBy('id', 'DESC')->simplePaginate($request->per_page);

        return PuestoResource::collection($puestos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PuestoStoreRequest $request): JsonResponse
    {
        $puesto = Puesto::create($request->all());

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
    public function update(Request $request, $puesto): JsonResponse
    {
        $puesto = Puesto::withTrashed()->findOrFail($puesto);
        $puesto->update($request->all());

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
