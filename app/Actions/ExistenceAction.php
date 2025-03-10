<?php

namespace App\Actions;

use Illuminate\Http\{Request, JsonResponse};
use Illuminate\Support\Facades\DB;
//use App\Models\Existence;

class ExistenceAction
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        /* Initialize query */
        $query = DB::table('view_stocks_by_accumulated_plus_unclosed_movements');

        // search
        $search = strtolower($request->input("search"));
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query
                //->where(\DB::raw('lower(int_cod)') , "like", "%$search%")
                //->orWhere(\DB::raw('lower(name)') , "like", "%$search%")
                ->where(DB::raw('lower(warehouse)') , "like", "%$search%");

            });
        }

        // sort
        $sort = $request->input("sort");
        $direction = $request->input("direction") == "desc" ? "desc" : "asc";
        if ($sort) {
            $query->orderBy($sort, $direction);
        }        

        // get paginated results
        $existence = $query
            ->paginate(5)
            ->appends(request()->query());

        $rows = json_decode(json_encode($existence), true); // to array 
  
        // add foreign fields to articles table
        foreach ($rows['data'] as $key => $value) {
            $article = DB::connection('pgsql_article')->table('articles')->find($value['id']);
            $rows['data'][$key]['int_cod'] = $article->int_cod;
            $rows['data'][$key]['name'] = $article->name;
            $rows['data'][$key]['description'] = $article->description;
        }
            
        return response()->json([
            "rows" => $rows,
            "sort" => $request->query("sort"),
            "direction" => $request->query("direction"),
            "search" => $request->query("search")
        ]);
    }
}


