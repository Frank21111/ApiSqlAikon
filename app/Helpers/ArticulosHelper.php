<?php
namespace App\Helpers;

use App\Models\Articulo;
use App\Models\ArticuloComprobante;

ini_set('max_execution_time', 600);
ini_set('memory_limit',  '-1');

class ArticulosHelper{
    //formato $desde Y-m-d
    public static function articulos_vendidos($desde){
        $articulosVendidos = ArticuloComprobante::where('MM_CODCOM', 'FAR')->where('MM_FECHA', '>', $desde .'T00:00:00')->distinct()->get(['AR_CODIGO']);
        $codigoArticulosVendidos = [];
        foreach($articulosVendidos as $articuloVendido){
            array_push($codigoArticulosVendidos, $articuloVendido->AR_CODIGO);

        }
        return $codigoArticulosVendidos;
    }

    public static function stock_cero_negativo($cero){
        $articulos = Articulo::get(['AR_CODIGO', 'AR_DESCRI']);
        $articulos_cero_negativo = [];
        foreach($articulos as $articulo){
            $negativo = false;
            $stock_articulo = array_reduce($articulo->stock->toArray(), function($acumulador, $stock) use ($negativo){
                                                                            if($negativo || $stock['ST_STOCK'] < 0){
                                                                                $negativo = true;
                                                                                $acumulador = -1;
                                                                                return $acumulador;
                                                                            } 
                                                                            return $acumulador += $stock['ST_STOCK'];
                                                                        });
            if($cero ? $stock_articulo == 0 : $stock_articulo < 0) array_push($articulos_cero_negativo, $articulo->AR_CODIGO);
        }
        return $articulos_cero_negativo;
        
    }

    public static function articulos_stock_cero_negativo_sin_ventas($desde){
        $articulosVendidos = self::articulos_vendidos($desde);
        $stockCero = self::stock_cero_negativo(true);
        $sinVentas = [];
        $articulos = Articulo::get(['AR_CODIGO']);
        foreach($articulos as $articulo){
            array_push($sinVentas, $articulo->AR_CODIGO);
        }
        $sinVentas = array_diff($sinVentas, $articulosVendidos);
        $sinVentasNiStock = array_intersect($sinVentas, $stockCero);

        return $sinVentasNiStock;
    }
}
