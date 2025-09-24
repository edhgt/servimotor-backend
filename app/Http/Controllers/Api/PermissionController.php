<?php

namespace App\Http\Controllers\Api;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissions = Permission::orderBy('id', 'DESC')->simplePaginate($request->per_page);

        return PermissionResource::collection($permissions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request): JsonResponse
    {
        $permission = Permission::create($request->all());

        return response()->json(new PermissionResource($permission));
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission): JsonResponse
    {
        return response()->json(new PermissionResource($permission));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, Permission $permission): JsonResponse
    {
        $permission->update($request->all());

        return response()->json(new PermissionResource($permission));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Permission $permission): Response
    {
        $permission->delete();

        return response()->noContent();
    }
}
