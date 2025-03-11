<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\{Movement, MovementDetail};
use App\Repositories\Article\ArticleRepository;

class MovementDetailController extends Controller
{
    /**
     * Display a listing of the resource by parent.
     */
    public function getAllByMovement(Request $request)//: Collection
    {
        //return response()->json($request, 201); $request->movementId
        
        $movementDetails = MovementDetail::select(
            "article_warehouse.*",
            "movement_details.*",
            "warehouses.name as warehouse_name",
            "warehouses.code as warehouse_code"
        )
        ->join('article_warehouse', 'movement_details.article_warehouse_id', '=', 'article_warehouse.id')
        ->join('warehouses', 'article_warehouse.warehouse_uuid', '=', 'warehouses.uuid')
        ->where('movement_id', $request->movementId)->get();

        $movementDetails = ArticleRepository::addForeignFields($movementDetails);
        
        return response()->json($movementDetails);
        //return MovementDetailRepository::getAllByMovement($request);
    }

    private static function validateTypeId(int $typeId)
    {
        if ($typeId===3) {
          return 1;
        } else if ($typeId===4) {
          return 2;
        } else {
          return 0;
        }

    }

    public function getAllByNumber(Request $request)//: Collection
    {
        $typeId = self::validateTypeId((int)$request->typeId);

        $movement = Movement::select('id')
            ->where([
                [ 'number', $request->supportNumber ],
                [ 'type_id', '=' , self::validateTypeId((int)$request->typeId) ]
            ])            
            ->first();
        
        if ($movement && $movement->id) {
            $movementDetails = MovementDetail::select(
                "article_warehouse.*",
                "movement_details.*",
                "warehouses.name as warehouse_name",
                "warehouses.code as warehouse_code"
            )
            ->join('article_warehouse', 'movement_details.article_warehouse_id', '=', 'article_warehouse.id')
            ->join('warehouses', 'article_warehouse.warehouse_uuid', '=', 'warehouses.uuid')      
            ->where('movement_id', $movement->id)
            ->get();

            $movementDetails = ArticleRepository::addForeignFields($movementDetails);

            return response()->json($movementDetails);
        }

        return response()->json([]);        
    }
 
}
