<?php

namespace Modules\Store\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\{Request, JsonResponse};
use Illuminate\Routing\Controller;
use Modules\Store\Http\Resources\SubWarehouseResource;
use Modules\Store\Http\Requests\SubWarehouse\{
    StoreSubWarehouseRequest,
    UpdateSubWarehouseRequest
};
use Modules\Store\Http\Services\SubWarehouse\{
    StoreSubWarehouseService,
    IndexSubWarehouseService,
    UpdateSubWarehouseService
};
use Modules\Store\Entities\SubWarehouse;

class SubWarehouseController extends Controller
{
    /*
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        return IndexSubWarehouseService::execute($request);
    }

    /**
     * Store a newly created resource in storage.
     */ 
    public function store(StoreSubWarehouseRequest $request): JsonResponse
    {
        return StoreSubWarehouseService::execute($request);
    }

    /**
     * Display the specified resource.
    */
    public function show(SubWarehouse $sub_warehouse): SubWarehouseResource | JsonResponse
    {
        return new SubWarehouseResource($sub_warehouse);
    }

    /**
     * Update the specified resource in storage.
     */     
    public function update(UpdateSubWarehouseRequest $request, SubWarehouse $sub_warehouse): JsonResponse
    {
        return UpdateSubWarehouseService::execute($request, $sub_warehouse);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse
    {      
        SubWarehouse::destroy($request->id);
        return response()->json(204);
    }

    /*
     * Display a listing of the resource to help.
     */
    public function help(): JsonResponse
    {
        return response()->json(SubWarehouse::all());
    }
}
