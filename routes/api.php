<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::middleware('auth:sanctum')->post('/productos', [ProductController::class, 'store']);
Route::post('/productos', [ProductController::class, 'store']);
Route::middleware('auth:api')->group(function () {
    Route::delete('/productos/{id}', 'ProductController@destroy')->name('productos.destroy');
    Route::put('productos/{id}/activar', 'ProductController@activar')->name('productos.activar');
});
