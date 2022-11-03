<?php

use App\Helpers\ArticulosHelper;
use App\Http\Controllers\ListaPrecioController;
use App\Http\Controllers\Mercaderia\ArticulosController;
use App\Http\Controllers\MarcaController;
use App\Helpers\PreciosHelper;
use Illuminate\Support\Facades\Route;

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

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

Route::middleware(['cors'])->group(function () {
    //Rutas a las que se permitirá acceso
    Route::prefix('/articulosHelper')->group(function(){
        Route::get('/sin_stock_ni_ventas/{fecha}', [ArticulosHelper::class, 'articulos_stock_cero_negativo_sin_ventas']);
        Route::get('/sin_stock_ni_ventas_inactivar/{fecha}', [ArticulosHelper::class, 'articulos_stock_cero_negativo_sin_ventas_inactivar']);
        Route::get('/sin_stock_ni_ventas_excel/{fecha}', [ArticulosHelper::class, 'articulos_stock_cero_negativo_sin_ventas_excel']);
        Route::post('/modificarStock', [ArticulosHelper::class, 'modificarStock']);
    });


    Route::prefix('/articulos')->group(function(){
        Route::get('index',             [ArticulosController::class, 'index']);
        Route::get('show/{ar_codigo}',  [ArticulosController::class, 'show']);
    });

    Route::get('/marcas',               [MarcaController::class, 'index']);
    Route::prefix('/precios')->group(function(){   
        Route::get('/listasprecio',         [ListaPrecioController::class, 'index']);
        Route::post('/precioarticulos',      [PreciosHelper::class, 'articulosPrecios']);
     });

});