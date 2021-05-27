<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('categories.index');
});
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);

//Route::resource('attachproduct', CategoryController::class);

Route::get('/attachToCategory/{id}', [ProductController::class, 'attachToCategory'])->name('products.attachToCategory');

Route::post('/deAttachFromCategory/{product_id}/{category_id}', [ProductController::class, 'deAttachFromCategory'])->name('products.deAttachFromCategory');

Route::get('/saveCategoryWithProduct/{id}', [ProductController::class, 'saveCategoryWithProduct'])->name('products.saveCategoryWithProduct');


