<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
     
Route::middleware('auth:api')->group( function () {
    Route::POST('categories', [CategoryController::class,'store']);
    Route::PUT('categories/{id}', [CategoryController::class,'update']);
    Route::DELETE('categories/{id}', [CategoryController::class,'destroy']);

    Route::POST('products', [ProductController::class,'store']);
    Route::PUT('products/{id}', [ProductController::class,'update']);
    Route::DELETE('products/{id}', [ProductController::class,'destroy']);

    Route::PUT('products/attachToCategory/{product_id}/{category_id}', [ProductController::class, 'attachToCategory']);
    Route::PUT('products/deAttachFromCategory/{product_id}/{category_id}', [ProductController::class, 'deAttachFromCategory']);


});

Route::GET('categories', [CategoryController::class,'index']);
Route::GET('categories/{id}', [CategoryController::class,'show']);

Route::GET('products', [ProductController::class,'index']);
Route::GET('products/{id}', [ProductController::class,'show']);





