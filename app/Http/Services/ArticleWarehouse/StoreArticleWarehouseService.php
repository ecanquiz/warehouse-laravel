<?php
namespace App\Http\Services\ArticleWarehouse;

use Illuminate\Http\{Request, JsonResponse};
use App\Http\Requests\ArticleWarehouse\StoreArticleWarehouseRequest;
use App\Models\ArticleWarehouse;

class StoreArticleWarehouseService
{
    // static public function execute(StoreArticleWarehouseRequest $request): JsonResponse
    static public function execute(Request $request): JsonResponse
    {
        foreach ($request->articleIds as $articleId) {
            $article_warehouse = new ArticleWarehouse;

            $article_warehouse->article_id = $articleId;
            $article_warehouse->warehouse_uuid = $request->warehouseUuid;
            $article_warehouse->stock_min = 5;
            $article_warehouse->stock_max = 5;
            $article_warehouse->status = 1;
            $article_warehouse->id_user_insert = 1;
            $article_warehouse->id_user_update = 1;
        
            $article_warehouse->save();
        }

        $article_warehouse->refresh();

        return response()->json([
            "message" => "New records created successfully", 
            "ids" => $request->articleIds
        ], 201);
    }

}