<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\{Request, JsonResponse};
use Illuminate\Routing\Controller;
use App\Http\Resources\ArticleWarehouseResource;
/*use App\Http\Requests\ArticleWarehouse\{
    StoreArticleWarehouseRequest,
    UpdateArticleWarehouseRequest
};*/
/*use App\Http\Services\ArticleWarehouse\{
    StoreArticleWarehouseService,
    IndexArticleWarehouseService,
    UpdateArticleWarehouseService
};*/
use App\Models\ArticleWarehouse;
//use Modules\Product\Entities\Presentation;
use Illuminate\Support\Facades\DB;

class ArticleWarehouseController extends Controller
{
    /*
     * Display a listing of the resource.
     */
    //public function index(Request $request): JsonResponse
    //{
    //    return IndexArticleWarehouseService::execute($request);
    //}

    /**
     * Store a newly created resource in storage.
     */ 
    //public function store(StoreArticleWarehouseRequest $request): JsonResponse
    //{
    //    return StoreArticleWarehouseService::execute($request);
    //}

    /**
     * Display the specified resource.
    */
    //public function show(ArticleWarehouse $articleWarehouse): ArticleWarehouseResource | JsonResponse
    //{
    //    return new ArticleWarehouseResource($articleWarehouse);
    //}

    /**
     * Update the specified resource in storage.
     */     
    //public function update(UpdateArticleWarehouseRequest $request, ArticleWarehouse $articleWarehouse): JsonResponse
    //{
    //    return UpdateArticleWarehouseService::execute($request, $articleWarehouse);
    //}

    /**
     * Remove the specified resource from storage.
     */
    //public function destroy(Request $request): JsonResponse
    //{      
    //    ArticleWarehouse::destroy($request->id);
    //    return response()->json(204);
    //}

    /*
     * Display a listing of the resource to help.
     */
    //public function help(): JsonResponse
    //{
    //    return response()->json(ArticleWarehouse::all());
    //}

    public function search(Request $request): JsonResponse
    {
        // Initialize query
        $query = ArticleWarehouse::query()
            ->selectRaw("
                    article_warehouse.id,
                    article_warehouse.int_cod,
                    article_warehouse.name,
                    article_warehouse.stock_min,
                    article_warehouse.stock_max,
                    article_warehouse.status,
                    article_warehouse.photo,
                    article_warehouse.warehouse_uuid,
                    warehouses.name as warehouse,
                    CASE WHEN view_stock_movement.total IS NULL THEN 0 ELSE view_stock_movement.total END as stock_existence")
            ->leftjoin("warehouses"  , "article_warehouse.warehouse_uuid"  , "=", "warehouses.uuid")
            ->leftjoin("view_stock_movement"  , "article_warehouse.id"  , "=", "view_stock_movement.article_warehouse_id");
;

        // search 
        $search = strtoupper($request->input("search"));
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query
                    ->where  (DB::raw("UPPER(article_warehouse.int_cod)"        ), "like", "%$search%")
                    ->orWhere(DB::raw("UPPER(article_warehouse.name)"  ), "like", "%$search%")
                    ->orWhere(DB::raw("UPPER(warehouses.name)"  ), "like", "%$search%");
            });
        }

        // sort 
        $sort = $request->input("sort");
        $direction = $request->input("direction") === "desc" ? "desc" : "asc";        
        ($sort)
            ? $query->orderBy($sort, $direction) 
                : $query->orderBy("article_warehouse.id", "asc");

        // get paginated results 
        $presentations = $query
            ->paginate(5)
            ->appends(request()->query());

        return response()->json([
            "rows" => $presentations,
            "sort" => $request->query("sort"),
            "direction" => $request->query("direction"),
            "search" => $request->query("search")
        ]);
    }
}
