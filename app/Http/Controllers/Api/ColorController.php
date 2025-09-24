<?php

namespace App\Http\Controllers\Api;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Requests\ColorRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ColorResource;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $colors = Color::withTrashed()->orderBy('id', 'DESC')->simplePaginate($request->per_page);

        return ColorResource::collection($colors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColorRequest $request): JsonResponse
    {
        $color = Color::create($request->all());

        return response()->json(new ColorResource($color));
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color): JsonResponse
    {
        return response()->json(new ColorResource($color));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $color): JsonResponse
    {
        $color = Color::withTrashed()->findOrFail($color);
        $color->update($request->all());

        return response()->json(new ColorResource($color));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Color $color): Response
    {
        $color->delete();

        return response()->noContent();
    }
}
