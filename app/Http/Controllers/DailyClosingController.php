<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\{Request, JsonResponse};
use Illuminate\Routing\Controller;
use DB;
use App\Http\Services\DailyClosing\{ IndexDailyClosingService };
// use App\Http\Requests\Movement\{ StoreMovementRequest, UpdateMovementRequest};

class DailyClosingController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return IndexDailyClosingService::execute($request);
    }

    public function show(Request $request): JsonResponse
    {
        $query = DB::table('close_days')
        ->selectRaw(
            'close,
            close_days.article_warehouse_id,
            article_warehouse.int_cod,
            article_warehouse.name,
            sum(accumulated) as accumulated,
            sum(quantity_input) as quantity_input, 
            sum(quantity_output) as quantity_output, 
            sum(quantity_reverse_input) as quantity_reverse_input, 
            sum(quantity_reverse_output) as quantity_reverse_output'
        )
        ->join('article_warehouse', 'close_days.article_warehouse_id', '=', 'article_warehouse.id')
        ->where('close', $request->close)
        ->groupBy('close', 'close_days.article_warehouse_id', 'article_warehouse.int_cod', 'article_warehouse.name')
        ->get();

        return response()->json($query);
    }

    public function getPreDailyClosing(): JsonResponse
    {
        $query = DB::table('view_closure_pre_insert')
        ->selectRaw(
            'date_time,
            view_closure_pre_insert.article_warehouse_id,
            article_warehouse.int_cod,
            article_warehouse.name,
            quantity_input,
            quantity_output,
            quantity_reverse_input,
            quantity_reverse_output'
        )
        ->join('article_warehouse', 'view_closure_pre_insert.article_warehouse_id', '=', 'article_warehouse.id')
        ->get();

        return response()->json($query);

    }

    public function store(Request $request): JsonResponse
    {


        //try {
            $date = $request->date;

            $result = DB::select("select daily_closing(?,?,?)", array($date, $date, 1));
            return response()->json($result);

        //} catch (\Exception $e){
            echo $e->getMessage();        
        //} 

        

        //return StoreMovementService::execute($request, $typeId);        
    }
    
    /*public function show(Movement $movement, Request $request): MovementResource | JsonResponse    
    {//return response()->json($movement);
        return new MovementResource($movement);
    }

    //public function store(StoreArticleRequest $request): JsonResponse
    */
}
