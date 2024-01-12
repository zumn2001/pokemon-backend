<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\client\ClientController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\RartyController;
use App\Http\Controllers\SetController;
use App\Http\Controllers\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->get('/admin', function (Request $request) {
    return $request->user();
});

Route::apiResource('images',ImageController::class);
Route::apiResource('rarities',RartyController::class);
Route::apiResource('sets',SetController::class);
Route::apiResource('types',TypeController::class);
Route::apiResource('cards',CardController::class);
Route::get('orders',[ClientController::class,'allOrders']);