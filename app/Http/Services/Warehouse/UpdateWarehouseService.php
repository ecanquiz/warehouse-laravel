<?php
namespace App\Http\Services\Warehouse;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\Warehouse\UpdateWarehouseRequest;
use App\Models\Warehouse;

class UpdateWarehouseService
{
    static public function execute(UpdateWarehouseRequest $request, Warehouse $warehouse): JsonResponse
    {          
        // $warehouse = Warehouse::find($request->id);

        // $warehouse->uuid = $request->uuid;
        $warehouse->name = $request->name;
        $warehouse->description = $request->description;
        $warehouse->categories = $request->categories;
        $warehouse->save();

        return response()->json([
            "message"=> "Record updated successfully"
        ], 200);      
    }
}

