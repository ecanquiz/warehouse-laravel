<?php
namespace App\Http\Services\SubWarehouse;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\SubWarehouse\StoreSubWarehouseRequest;
use App\Models\SubWarehouse;
use Illuminate\Support\Str;


class StoreSubWarehouseService
{
    static public function execute(StoreSubWarehouseRequest $request): JsonResponse
    {
        $sub_warehouse = new SubWarehouse;

        $sub_warehouse->uuid = (string)Str::uuid();
        $sub_warehouse->name = $request->name;
        $sub_warehouse->description = $request->description;
        
        $sub_warehouse->save();

        $sub_warehouse->refresh();

        return response()->json([
            "message" => "New record created successfully", 
            "id" => $sub_warehouse->id
        ], 201);
  }

}