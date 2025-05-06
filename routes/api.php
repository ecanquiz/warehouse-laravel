<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Actions\ExistenceAction;
use App\Http\Controllers\{
    ArticleWarehouseController,
    AuthController,
    AuthMenuController,
    UserController,
    TokenController,
    AvatarController,
    MenuController,
    RoleController,
    MovementController,
    MovementDetailController,
    DailyClosingController,
    WarehouseController
};


/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/


Route::post('/sanctum/token', TokenController::class);
Route::middleware(['auth:sanctum'])->group(function () {
    //Route::prefix('users')->middleware(['role:admin'])->group(function () {
    Route::prefix('users')->group(function () {
       Route::get('/auth', AuthController::class);
       Route::get('/auth-menu', AuthMenuController::class);
       Route::get('/{user}', [UserController::class, 'show']);        
       Route::get('/', [UserController::class, 'index']);
       Route::post('/', [UserController::class, 'store']);
       Route::post('/{user}', [UserController::class, 'update']);
       Route::delete('/{id}', [UserController::class,'destroy']);
       Route::post('/auth/avatar', [AvatarController::class, 'store']);
    });
       
    Route::prefix('menus')->group(function () {
        Route::get('/', [MenuController::class, 'index']);
        Route::get('/children/{menuId}', [MenuController::class, 'children']);
        Route::post('/', [MenuController::class, 'store']);  
        Route::put('/{menu}', [MenuController::class, 'update']);
        Route::delete('/{id}', [MenuController::class,'destroy']);
    });
   
    Route::prefix('roles')->group(function () {
        Route::get('/helperTables', fn() => response()->json([
            "roles" => \App\Models\Role::get()
        ], 200));
        Route::get('/{role}', [RoleController::class, 'show']);
        Route::get('/', [RoleController::class, 'index']);       
        Route::post('/', [RoleController::class, 'store']);        
        Route::put('/{role}', [RoleController::class, 'update']);
        Route::delete('/{id}', [RoleController::class,'destroy']);        
    });

    Route::prefix('movements')->group(function () {
        Route::get('/{typeId?}', [MovementController::class, 'index']);        
        Route::get('/{movement}/{typeId}', [MovementController::class, 'show']);
        Route::post('/{typeId}', [MovementController::class, 'store']);
        Route::put('/{movement}', [MovementController::class, 'update']);
        Route::delete('/{typeId}/{id}', [MovementController::class,'destroy']);
    });

    /*Route::prefix('movements')->group(function () {
        Route::get('/', [MovementController::class, 'index']);
        Route::get('/{movement}', [MovementController::class, 'show']);
        Route::post('/', [MovementController::class, 'store']);
        Route::put('/{movement}', [MovementController::class, 'update']);
        Route::delete('/{id}', [MovementController::class,'destroy']);
    });*/

    Route::get('/movements-help', [MovementController::class, 'help']);

    Route::get('/summary', [ExistenceAction::class, 'index'] );

    Route::prefix('movement_details')->group(function () {  
        Route::get('/{movementId}', [MovementDetailController::class, 'getAllByMovement']);
        Route::get('/{movement_detail}', [MovementDetailController::class, 'show']);
        Route::post('/', [MovementDetailController::class, 'store']);
        Route::put('/{movement_detail}', [MovementDetailController::class, 'update']);
        Route::delete('/{id}', [MovementDetailController::class,'destroy']);
    });
    Route::get('/movement_details_by_number/{supportNumber}/{typeId}', [MovementDetailController::class, 'getAllByNumber']);

    Route::prefix('daily-closings')->group(function () { 
        Route::get('/', [DailyClosingController::class, 'index']);
        Route::get('/pre', [DailyClosingController::class, 'getPreDailyClosing']);
        Route::get('/{close}', [DailyClosingController::class, 'show']);
        Route::post('/', [DailyClosingController::class, 'store']);
    });

    Route::prefix('warehouses')->group(function () {
        Route::get('/', [WarehouseController::class, 'index']);
        Route::get('/{warehouse}', [WarehouseController::class, 'show']);
        Route::get('/{warehouse}/uuid', [WarehouseController::class, 'showByUuid']);
        Route::post('/', [WarehouseController::class, 'store']);
        Route::put('/{warehouse}', [WarehouseController::class, 'update']);
        Route::delete('/{id}', [WarehouseController::class,'destroy']);
    });
    Route::get('/warehouses-help', [WarehouseController::class, 'help']);
    // Route::get('/articles-warehouse', [ArticleWarehouseController::class,'index']);
    Route::get('/articles-warehouse-search', [ArticleWarehouseController::class,'search']);
    Route::put('/warehouses-load-articles/{warehouse}', [WarehouseController::class, 'loadArticles']);
    
    
    Route::prefix('article-warehouse')->group(function () {
        Route::get('/', [ArticleWarehouseController::class, 'index']);
        Route::get('/{article_warehouse}', [ArticleWarehouseController::class, 'show']);
        Route::post('/', [ArticleWarehouseController::class, 'store']);
        Route::put('/{article_warehouse}', [ArticleWarehouseController::class, 'update']);
        Route::delete('/{id}', [ArticleWarehouseController::class,'destroy']);
    });
    Route::get('/article_warehouse-help', [ArticleWarehouseController::class, 'help']);


});

Route::prefix('error')->group(function () {
    Route::get('/not-auth', function(){        
        abort(403, 'This action is not authorized.');        
    });

    Route::get('/not-found', function(){        
        abort(404, 'Page not found.');        
    });

    Route::get('/', function(){        
        abort(500, 'Something went wrong');        
    });
    /*Route::get('/custom', function(){
        throw new \App\Exceptions\CustomException('Error: Levi Strauss & CO.', 501);
    });*/
});

Route::get('/sales-catalog', function(){        
    return response()->json([
        [
            "name" => "Plain Ol' Pineapple",
            "image"=> "pineapple-original.jpg",
            "price" => 4
        ], [
            "name" => "Dried Pineapple",
            "image" => "pineapple-dried.jpg",
            "price" => 5
        ], [
            "name" => "Pineapple Gum",
            "image" => "pineapple-gum.jpg",
            "price" => 3
        ], [
            "name" => "Pineapple T-Shirt",
            "image" => "pineapple-tshirt.jpg",
            "price" => 12
        ], [
            "name" => "PPlain Ol' Pineapple",
            "image" => "pineapple-original.jpg",
            "price" => 44
        ], [
            "name" => "DDried Pineapple",
            "image" => "pineapple-dried.jpg",
            "price" => 55
        ], [
            "name" => "PPineapple Gum",
            "image" => "pineapple-gum.jpg",
            "price" =>  33
        ], [
            "name" => "PPineapple T-Shirt",
            "image" => "pineapple-tshirt.jpg",
            "price"  => 123
        ], [
            "name" => "PPPlain Ol' Pineapple",
            "image"  => "pineapple-original.jpg",
            "price"  => 444
        ], [
            "name"  => "DDDried Pineapple",
            "image" => "pineapple-dried.jpg",
            "price" => 555
        ], [
            "name"  => "PPPineapple Gum",
            "image"  => "pineapple-gum.jpg",
            "price"  => 333
        ], [
            "name" => "PPPineapple T-Shirt",
            "image" => "pineapple-tshirt.jpg",
            "price"  => 321
        ]
    ]);
});