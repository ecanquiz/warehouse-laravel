<?php

namespace Modules\Store\Http\Services\Movement;

use Illuminate\Http\{
    Request,
    JsonResponse
};
use Modules\Article\Entities\Article;
use Modules\Store\Entities\Movement;

class IndexMovementService
{

    /**
     * Display a listing of the resource.
     */
    static public function execute(Request $request): JsonResponse 
    {      
        //return response()->json(Movement::all());
        //return IndexArticleService::execute($request);
        /* Initialize query */
        $query = Movement::query();
        if ($request->typeId)
            $query->where("type_id", $request->typeId);

        /* search */
        $search = strtolower($request->input("search"));
        /*if ($search) {
            $query->where(function ($query) use ($search) {
                $query
                ->where(\DB::raw('lower(int_cod)') , "like", "%$search%")                
                ->orWhere(\DB::raw('lower(name)') , "like", "%$search%")                
                ->orWhere(\DB::raw('lower(price)') , "like", "%$search%")                
                ->orWhere(\DB::raw('lower(stock_min)') , "like", "%$search%")                
                ->orWhere(\DB::raw('lower(stock_max)') , "like", "%$search%")                
                ->orWhere(\DB::raw('lower(status)') , "like", "%$search%")                
                ->orWhere(\DB::raw('lower(photo)') , "like", "%$search%")                
                ->orWhere(\DB::raw('lower(id_user_insert)') , "like", "%$search%")                
                ->orWhere(\DB::raw('lower(id_user_update)') , "like", "%$search%")                
                ;
            });
        }*/

        /* sort */
        $sort = $request->input("sort") ?? 'id';
        $direction = $request->input("direction") == "asc" ? "asc" : "desc";
        if ($sort) {
            $query->orderBy($sort, $direction);
        }

        /* get paginated results */
        $movements = $query
            ->paginate(5)
            ->appends(request()->query());
            
        return response()->json([
            "rows" => $movements,
            "sort" => $request->query("sort"),
            "direction" => $request->query("direction"),
            "search" => $request->query("search")
        ]);
    }  

}


