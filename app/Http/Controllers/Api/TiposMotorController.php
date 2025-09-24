<?php

namespace App\Http\Controllers\Api;

use App\Models\TipoMotor;
use Illuminate\Http\Request;
use App\Http\Requests\TiposMotorRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\TiposMotorResource;

class TiposMotorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tiposMotors = TipoMotor::orderBy('id', 'DESC')->simplePaginate($request->per_page);

        return TiposMotorResource::collection($tiposMotors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TiposMotorRequest $request): JsonResponse
    {
        $tiposMotor = TipoMotor::create($request->all());

        return response()->json(new TiposMotorResource($tiposMotor));
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoMotor $tiposMotor): JsonResponse
    {
        return response()->json(new TiposMotorResource($tiposMotor));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoMotor $tiposMotor): JsonResponse
    {
        $tiposMotor->update($request->all());

        return response()->json(new TiposMotorResource($tiposMotor));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(TipoMotor $tiposMotor): Response
    {
        $tiposMotor->delete();

        return response()->noContent();
    }
}
