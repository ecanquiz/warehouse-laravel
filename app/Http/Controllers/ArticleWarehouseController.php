<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\{Request, JsonResponse};
use Illuminate\Routing\Controller;
use App\Http\Resources\ArticleWarehouseResource;
use App\Http\Requests\ArticleWarehouse\{
    StoreArticleWarehouseRequest,
    UpdateArticleWarehouseRequest
};
use App\Http\Services\ArticleWarehouse\{
    IndexArticleWarehouseService,
    SearchArticleWarehouseService,
    StoreArticleWarehouseService,
    UpdateArticleWarehouseService
};
use App\Models\ArticleWarehouse;

class ArticleWarehouseController extends Controller
{
    /*
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        return IndexArticleWarehouseService::execute($request);
    }

    /**
     * Store a newly created resource in storage.
     */ 
    public function store(StoreArticleWarehouseRequest $request): JsonResponse
    {
        return StoreArticleWarehouseService::execute($request);
    }

    /**
     * Display the specified resource.
    */
    public function show(ArticleWarehouse $article_warehouse): ArticleWarehouseResource | JsonResponse
    {
        return new ArticleWarehouseResource($article_warehouse);
    }

    /**
     * Update the specified resource in storage.
     */     
    public function update(UpdateArticleWarehouseRequest $request, ArticleWarehouse $article_warehouse): JsonResponse
    {
        return UpdateArticleWarehouseService::execute($request, $article_warehouse);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse
    {      
        ArticleWarehouse::destroy($request->id);
        return response()->json(204);
    }

    /*
     * Display a listing of the resource to help.
     */
    public function help(): JsonResponse
    {
        return response()->json(ArticleWarehouse::all());
    }

    /*
     * Display a listing of the resource.
     */
    public function search(Request $request): JsonResponse
    {        
        return SearchArticleWarehouseService::execute($request);
    }
}