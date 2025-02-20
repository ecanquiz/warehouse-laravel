<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\Collection;
use App\Models\{Movement, MovementDetail};
//use Modules\Article\Repositories\ArticleDetailRepository;
//use Modules\Article\Http\Requests\ArticleDetail\{
//    StoreArticleDetailRequest,
//    UpdateArticleDetailRequest    
//};
//use Modules\Article\Http\Services\ArticleDetail\{
//    StoreArticleDetailService,
//    UpdateArticleDetailService
//}; 

class MovementDetailController extends Controller
{
    /**
     * Display a listing of the resource by parent.
     */
    public function getAllByMovement(Request $request)//: Collection
    {
        //return response()->json($request, 201); $request->movementId
        
        $movementDetails = MovementDetail::
          select("articles.*", "movement_details.*")
          ->join('articles', 'movement_details.article_id', '=', 'articles.id')        
          ->where('movement_id', $request->movementId)->get();
        
        return response()->json($movementDetails);
        //return MovementDetailRepository::getAllByMovement($request);
    }

    private static function validateTypeId(int $typeId)
    {
        if ($typeId===3) {
          return 1;
        } else if ($typeId===4) {
          return 2;
        } else {
          return 0;
        }

    }

    public function getAllByNumber(Request $request)//: Collection
    {
        $typeId = self::validateTypeId((int)$request->typeId);

        $movement = Movement::select('id')
            ->where([
                [ 'number', $request->supportNumber ],
                [ 'type_id', '=' , self::validateTypeId((int)$request->typeId) ]
            ])            
            ->first();
        
        if ($movement && $movement->id) {
            $movementDetails = MovementDetail::select("articles.*", "movement_details.*")
                ->join('articles', 'movement_details.article_id', '=', 'articles.id')        
                ->where('movement_id', $movement->id)
                ->get();

            return response()->json($movementDetails);
        }

        return response()->json([]);        
    }    

    /**
     * Store a newly created resource in storage.
     */    
    //public function store(StoreArticleDetailRequest $request): JsonResponse
    //public function store(Request $request): JsonResponse
    //{
    //    //return  response()->json($request, 201);
    //    return StoreArticleDetailService::execute($request);
    //}
    
    /**
     * Update the specified resource in storage.
     */
    //public function update(UpdateArticleDetailRequest $request, ArticleDetail $article_detail): JsonResponse
    //{
    //    return UpdateArticleDetailService::execute($request, $article_detail);
    //}

    /**
     * Remove the specified resource from storage.
     */
    //public function destroy(Request $request): JsonResponse
    //{
    //    ArticleDetail::destroy($request->id);

    //    return response()->json(204);            
    //}
}
