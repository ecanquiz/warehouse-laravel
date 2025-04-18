<?php

namespace App\Http\Services\Warehouse;

use Illuminate\Http\{
    Request,
    JsonResponse
};
use App\Models\Warehouse;

class IndexWarehouseService
{

  /**
   * Display a listing of the resource.
   */
  static public function execute(Request $request): JsonResponse
  {
      /* Initialize query */
        $query = Warehouse::query();

        /* search */
        $search = strtolower($request->input("search"));
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query
                ->where(\DB::raw('lower(uuid)') , "like", "%$search%")                
                ->orWhere(\DB::raw('lower(name)') , "like", "%$search%")                
                ->orWhere(\DB::raw('lower(description)') , "like", "%$search%")                
                ;
            });
        }

        /* sort */
        $sort = $request->input("sort");
        $direction = $request->input("direction") == "desc" ? "desc" : "asc";
        if ($sort) {
            $query->orderBy($sort, $direction);
        }

        /* get paginated results */
        $warehouses = $query
            ->paginate(5)
            ->appends(request()->query());
            
        return response()->json([
            "rows" => $warehouses,
            "sort" => $request->query("sort"),
            "direction" => $request->query("direction"),
            "search" => $request->query("search")
        ]);

  }  

}
