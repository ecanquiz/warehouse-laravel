<?php

namespace App\Http\Services\DailyClosing;

use Illuminate\Http\{
    Request,
    JsonResponse
};
use App\Models\DailyClosing;

class IndexDailyClosingService
{

    /**
     * Display a listing of the resource.
     */
    static public function execute(Request $request): JsonResponse 
    {
        /* Initialize query */
        /*$query = DailyClosing::selectRaw(
            'close, 
            sum(quantity_input) as quantity_input, 
            sum(quantity_output) as quantity_output, 
            sum(quantity_reverse_input) as quantity_reverse_input, 
            sum(quantity_reverse_output) as quantity_reverse_output'
        )
        ->groupBy('close');*/

        $query = DailyClosing::select('close')->groupBy('close');


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
        $sort = $request->input("sort") ?? 'close';
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


