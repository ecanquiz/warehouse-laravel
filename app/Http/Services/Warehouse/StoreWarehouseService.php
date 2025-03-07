<?php
namespace App\Http\Services\Warehouse;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\Warehouse\StoreWarehouseRequest;
use App\Models\Warehouse;
use Illuminate\Support\Str;


class StoreWarehouseService
{
    static public function execute(StoreWarehouseRequest $request): JsonResponse
    {
        $warehouse = new Warehouse;

        $warehouse->uuid = (string)Str::uuid();
        $warehouse->name = $request->name;
        $warehouse->description = $request->description;
        $warehouse->categories = json_encode($request->categories);
        
        $warehouse->save();

        $warehouse->refresh();

        return response()->json([
            "message" => "Nuevo registro creado exitosamente", 
            "id" => $warehouse->id
        ], 201);
  }

}