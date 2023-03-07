<?php

use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\Notification;
use App\Http\Controllers\Api\PackgeController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SoftwareController;
use App\Models\Product;
use App\Models\Stock;
use App\Rules\DocumentRule;
use App\Rules\StockRule;
use Illuminate\Support\Facades\Route;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */
Route::apiResources([
    'softwre' => SoftwareController::class,
    "products"=>ProductController::class,
    "documents"=>DocumentController::class,
    "items"=>ItemController::class,
    "packges"=>PackgeController::class,
    "notice"=>Notification::class
]);

Route::get("/teste/{amount?}",function($amount,DocumentRule $documentRule){
  return response()->json($documentRule->discounts($amount,1000));
});