<?php

use Illuminate\Http\Request;
use App\Helpers\ArticulosHelper;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/articulosHelper')->group(function(){
    Route::get('/sin_stock_ni_ventas/{fecha}', [ArticulosHelper::class, 'articulos_stock_cero_negativo_sin_ventas']);
});