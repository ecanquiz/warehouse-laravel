<?php
namespace App\Http\Services\ArticleWarehouse;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\ArticleWarehouse\StoreArticleWarehouseRequest;
use App\Models\ArticleWarehouse;

class StoreArticleWarehouseService
{
    static public function execute(StoreArticleWarehouseRequest $request): JsonResponse
    {
        $article_warehouse = new ArticleWarehouse;

        $article_warehouse->article_id = $request->article_id;
        $article_warehouse->warehouse_uuid = $request->warehouse_uuid;
        $article_warehouse->stock_min = $request->stock_min;
        $article_warehouse->stock_max = $request->stock_max;
        $article_warehouse->status = $request->status;
        $article_warehouse->id_user_insert = $request->id_user_insert;
        $article_warehouse->id_user_update = $request->id_user_update;
        
        $article_warehouse->save();

        $article_warehouse->refresh();

        return response()->json([
            "message" => "New record created successfully", 
            "id" => $article_warehouse->id
        ], 201);
  }

}