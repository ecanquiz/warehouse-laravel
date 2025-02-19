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
                ->where(\DB::raw('lower(int_cod)') , "like", "%$search%")
                ->orWhere(\DB::raw('lower(name)') , "like", "%$search%");
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
            
        return response()->json([
            "rows" => $existence,
            "sort" => $request->query("sort"),
            "direction" => $request->query("direction"),
            "search" => $request->query("search")
        ]);
    }
}


