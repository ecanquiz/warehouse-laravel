<?php

namespace App\Http\Controllers;

// use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\{Request, JsonResponse};
use Illuminate\Routing\Controller;
use App\Http\Resources\WarehouseResource;
use App\Http\Requests\Warehouse\{
    StoreWarehouseRequest,
    UpdateWarehouseRequest
};
use App\Http\Services\Warehouse\{
    StoreWarehouseService,
    IndexWarehouseService,
    UpdateWarehouseService
};
use App\Models\Warehouse;

class WarehouseController extends Controller
{
    /*
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        return IndexWarehouseService::execute($request);
    }

    /**
     * Store a newly created resource in storage.
     */ 
    public function store(StoreWarehouseRequest $request): JsonResponse
    {
        return StoreWarehouseService::execute($request);
    }

    /**
     * Display the specified resource.
    */
    public function show(Warehouse $warehouse): WarehouseResource | JsonResponse
    {
        return new WarehouseResource($warehouse);
    }

    /**
     * Update the specified resource in storage.
     */     
    public function update(UpdateWarehouseRequest $request, Warehouse $warehouse): JsonResponse
    {
        return UpdateWarehouseService::execute($request, $warehouse);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse
    {      
        Warehouse::destroy($request->id);
        return response()->json(204);
    }

    /*
     * Display a listing of the resource to help.
     */
    public function help(): JsonResponse
    {
        return response()->json(Warehouse::all());
    }
}
