<?php

namespace App\Http\Controllers\Api;

use App\Models\FormaPago;
use Illuminate\Http\Request;
use App\Http\Requests\FormasPagoRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\FormasPagoResource;

class FormasPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $formasPagos = FormaPago::orderBy('id', 'DESC')->simplePaginate($request->per_page);

        return FormasPagoResource::collection($formasPagos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormasPagoRequest $request): JsonResponse
    {
        $formasPago = FormaPago::create($request->validated());

        return response()->json(new FormasPagoResource($formasPago));
    }

    /**
     * Display the specified resource.
     */
    public function show(FormaPago $formasPago): JsonResponse
    {
        return response()->json(new FormasPagoResource($formasPago));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormasPagoRequest $request, FormaPago $formasPago): JsonResponse
    {
        $formasPago->update($request->validated());

        return response()->json(new FormasPagoResource($formasPago));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(FormaPago $formasPago): Response
    {
        $formasPago->delete();

        return response()->noContent();
    }
}
