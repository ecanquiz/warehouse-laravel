<?php

namespace App\Http\Services\ArticleWarehouse;

use Illuminate\Http\{
    Request,
    JsonResponse
};
use App\Models\ArticleWarehouse;
use App\Repositories\Article\ArticleRepository;

class SearchArticleWarehouseService
{

    /**
    * Display a listing of the resource.
    */
    static public function execute(Request $request): JsonResponse
    {
        // Initialize query        
        $query = ArticleWarehouse::query()
            ->selectRaw("
                article_warehouse.id,
                article_warehouse.article_id,
                article_warehouse.stock_min,
                article_warehouse.stock_max,
                article_warehouse.status,
                article_warehouse.warehouse_uuid,
                warehouses.code as warehouse_code,
                warehouses.name as warehouse_name,
                CASE WHEN view_stock_movement.total IS NULL THEN 0 ELSE view_stock_movement.total END as stock_existence")
            ->leftjoin("warehouses"  , "article_warehouse.warehouse_uuid" , "=", "warehouses.uuid")
            ->leftjoin("view_stock_movement"  , "article_warehouse.id" , "=", "view_stock_movement.article_warehouse_id");

        // search 
        $search = strtoupper($request->input("search"));
        if ($search) {
            $articleIds = DB::connection('pgsql_article')
                ->table('articles')
                ->select('id')
                ->where(DB::raw("UPPER(articles.int_cod)"), "like", "%$search%")
                ->orWhere(DB::raw("UPPER(articles.name)"), "like", "%$search%")
                ->orWhere(DB::raw("UPPER(articles.description)"), "like", "%$search%")
                ->get()
                ->pluck('id')
                ->toArray();

            $query->where(function ($query) use ($search, $articleIds) {
                $query
                    ->whereIn("article_warehouse.article_id", $articleIds)
                    ->orWhere(DB::raw("UPPER(warehouses.code)"), "like", "%$search%")
                    ->orWhere(DB::raw("UPPER(warehouses.name)"), "like", "%$search%");
            });
        }

        // sort 
        $sort = $request->input("sort");
        $direction = $request->input("direction") === "desc" ? "desc" : "asc";        
        ($sort)
            ? $query->orderBy($sort, $direction) 
                : $query->orderBy("article_warehouse.id", "asc");

        // get paginated results 
        $articleWarehouse = $query
            ->paginate(5)
            ->appends(request()->query());

        $articleWarehouse = ArticleRepository::addForeignFields($articleWarehouse);

        return response()->json([
            "rows" => $articleWarehouse,
            "sort" => $request->query("sort"),
            "direction" => $request->query("direction"),
            "search" => $request->query("search")
        ]);

    }  

}
