<?php

namespace App\Http\Controllers;

use Illuminate\Http\{Request, JsonResponse};
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\User\{
    StoreUserRequest,
    UpdateUserRequest
};
use App\Http\Services\User\{
    StoreUserService,
    IndexUserService,
    UpdateUserService
};

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        if (Auth::user()->isAdmin()) {
            return IndexUserService::execute($request);            
        }
        return  response()->json(["message" => "Forbidden"], 403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\User\StoreUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */ 
    public function store(StoreUserRequest $request): JsonResponse
    {
        if (Auth::user()->isAdmin()) {
            return StoreUserService::execute($request);
        }
        return  response()->json(["message" => "Forbidden"], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\UserResource | \Illuminate\Http\Response
     */
    public function show(User $user): UserResource | JsonResponse
    {
        if (Auth::user()->isAdmin()) {
          return new UserResource($user);
        }
        return  response()->json(["message" => "Forbidden"], 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\User\UpdateUserRequest $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */     
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        if (Auth::user()->isAdmin()) {
            return UpdateUserService::execute($request, $user);
        }
        return  response()->json(["message" => "Forbidden"], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {      
        if (Auth::user()->isAdmin()) {
            User::destroy($request->id);
            return response()->json(204);            
        }
        return  response()->json(["message" => "Forbidden"], 403);
    }
}
