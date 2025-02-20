<?php
namespace App\Http\Services\SubWarehouse;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\SubWarehouse\UpdateSubWarehouseRequest;
use App\Models\SubWarehouse;

class UpdateSubWarehouseService
{
    static public function execute(UpdateSubWarehouseRequest $request, SubWarehouse $sub_warehouse): JsonResponse
    {          
        // $sub_warehouse = SubWarehouse::find($request->id);

        // $sub_warehouse->uuid = $request->uuid;
        $sub_warehouse->name = $request->name;
        $sub_warehouse->description = $request->description;
        
        $sub_warehouse->save();

        return response()->json([
            "message"=> "Record updated successfully"
        ], 200);      
    }
}

