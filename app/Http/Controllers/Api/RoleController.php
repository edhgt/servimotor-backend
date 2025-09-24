<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

use Spatie\Permission\Models\Role;

use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = Role::with('permissions')
        ->orderBy('id', 'DESC')
        ->simplePaginate($request->per_page);

        return RoleResource::collection($roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request): JsonResponse
    {
        $role = Role::create($request->all());

        return response()->json(new RoleResource($role));
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role): JsonResponse
    {
        return response()->json(new RoleResource($role));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role): JsonResponse
    {
        $role->update($request->all());

        return response()->json(new RoleResource($role));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Role $role): Response
    {
        $role->delete();

        return response()->noContent();
    }
}
