<?php

namespace App\Http\Controllers\Api;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests\ClienteStoreRequest;
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
        $query = Cliente::orderBy('id', 'DESC');

        if($request->has('q')) {
            if($request->column == 'nombre_completo') {
                $query->orWhere('primer_nombre', 'LIKE', "%{$request->q}%")
                    ->orWhere('segundo_nombre', 'LIKE', "%{$request->q}%")
                    ->orWhere('primer_apellido', 'LIKE', "%{$request->q}%")
                    ->orWhere('segundo_apellido', 'LIKE', "%{$request->q}%");
            } else {
                $query->where($request->column, 'LIKE', "%{$request->q}%");
            }
        }

        $clientes = $query->simplePaginate($request->per_page);

        return ClienteResource::collection($clientes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClienteStoreRequest $request): JsonResponse
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
    public function update(Request $request, $cliente): JsonResponse
    {
        $cliente = Cliente::withTrashed()->findOrFail($cliente);
        $cliente->update($request->all());

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
