<?php

use App\Http\Controllers\CalculateFreightController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\SalesOrderController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('products', ProductController::class);

Route::apiResource('product-types', ProductTypeController::class);

Route::apiResource('sales-orders', SalesOrderController::class);

Route::get('calculate-freight', CalculateFreightController::class);