<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\{Request, JsonResponse};
use Illuminate\Routing\Controller;
use App\Models\Movement;
use App\Http\Resources\MovementResource;
use App\Http\Services\Movement\{ IndexMovementService, StoreMovementService };
// use App\Http\Requests\Movement\{ StoreMovementRequest, UpdateMovementRequest};

class MovementController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return IndexMovementService::execute($request);
    }
    
    public function show(Movement $movement, Request $request): MovementResource | JsonResponse    
    {//return response()->json($movement);
        return new MovementResource($movement);
    }

    //public function store(StoreArticleRequest $request): JsonResponse
    public function store(Request $request, string $typeId): JsonResponse
    {
        return StoreMovementService::execute($request, $typeId);        
    }
}
