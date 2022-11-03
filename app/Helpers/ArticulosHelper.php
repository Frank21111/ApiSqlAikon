<?php
namespace App\Helpers;

use App\Models\Articulo;
use Illuminate\Database\Eloquent\Builder;
use App\Exports\ArticuloExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;



ini_set('max_execution_time', 600);
ini_set('memory_limit',  '-1');

class ArticulosHelper{
    public static function articulos_stock_cero_negativo_sin_ventas($desde){
        
        $PerfumeriaAutie = 930;
        try{
            $sinVentas = Articulo::disponible()
                                ->whereDoesntHave('comprobantes', function (Builder $query) use ($desde){
                                    $query->where('MM_CODCOM', 'FAR')->where('MM_FECHA', '>', $desde .'T00:00:00');})
                                ->whereHas('stock', function (Builder $query){
                                    $query->havingRaw('SUM(ST_STOCK) = 0');})
                                ->whereHas('marca', function (Builder $query) use ($PerfumeriaAutie){
                                    $query->where('MA_CODIGO', '!=' , $PerfumeriaAutie);})
                                ->get(['AR_CODIGO'
                                ,'AR_DESCRI'
                                ,'AR_BARRAS'] );
            
            return response(['articulos'=>$sinVentas, 'message'=>'Articulos recuperados exitosamente', 'type'=>'success']);
        }catch(\Exception $e){
            return response(['message'=>'Ocurrio un error al buscar los articulos', 'type'=>'error']);
        }
    }

    public static function articulos_stock_cero_negativo_sin_ventas_excel($desde){
        try{
            return Excel::download(new ArticuloExport($desde, true), 'articulos.xlsx');
        }catch(\Exception $e){
            return response(['message'=>'Ocurrio un error con el archivo excel', 'type'=>'error']);
        }
    }

    public static function articulos_stock_cero_negativo_sin_ventas_inactivar($desde){
        try{
            $PerfumeriaAutie = 930;

            $articulos = Articulo::disponible()
            ->whereDoesntHave('comprobantes', function (Builder $query) use ($desde){
                $query->where('MM_CODCOM', 'FAR')->where('MM_FECHA', '>', $desde .'T00:00:00');})
            ->whereHas('stock', function (Builder $query){
                $query->havingRaw('SUM(ST_STOCK) = 0');})
            ->whereHas('marca', function (Builder $query) use ($PerfumeriaAutie){
                $query->where('MA_CODIGO', '!=' , $PerfumeriaAutie);})
            ->get();
            // foreach($articulos as $articulo){
            //     $articulo->update(['ESA_CODIGO'=>'03']);
            // }
            return response(['message'=>'Articulos inactivados exitosamente', 'type'=>'success', 'articulos'=>$articulos]);
        }catch(\Exception $e){
            return response(['message'=>'Ocurrio un error al inactivar los articulos', 'type'=>'error']);
        }
    }
    public static function modificarStock(Request $request){
       
        try{
            $articulos = $request->articulos;
            foreach($articulos as $articulo){
                $depositos = Articulo::where('AR_CODIGO', $articulo['AR_CODIGO'])->first()->stock;
                foreach($depositos as $deposito){
                    $deposito->update(['ST_MINIMO'=>1, 'ST_MAXIMO'=>2]);
                }
            }
            return response(['message'=>'Stock modificado con exito', 'type'=>'success']);
        }catch(\Exception $e){
            return response(['message'=>'Ocurrio un error al modificar el stock', 'type'=>'error', 'error'=>$e]);
        }
    }
}


