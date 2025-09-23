<?php

namespace App\Http\Controllers\Api;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClienteResource;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clientes = Cliente::paginate();

        return ClienteResource::collection($clientes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClienteRequest $request): JsonResponse
    {
        $cliente = Cliente::create($request->validated());

        return response()->json(new ClienteResource($cliente));
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente): JsonResponse
    {
        return response()->json(new ClienteResource($cliente));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClienteRequest $request, Cliente $cliente): JsonResponse
    {
        $cliente->update($request->validated());

        return response()->json(new ClienteResource($cliente));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Cliente $cliente): Response
    {
        $cliente->delete();

        return response()->noContent();
    }
}
