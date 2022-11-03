<?php
namespace App\Helpers;

use App\Models\Articulo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;



ini_set('max_execution_time', 600);
ini_set('memory_limit',  '-1');

class PreciosHelper{
    public function articulosPrecios(Request $request){
        try{
            $marcas = $request->marcas;
            $listas = $request->listas;
            $articulos = Articulo::disponible()->whereHas('marca', function(Builder $query) use ($marcas) { return $query->whereIn('MA_CODIGO', $marcas);})->get();
            $articulos->load(['marca', 
                              'precios'=>function($query) use ($listas) { return $query->whereIn('LP_CODIGO', $listas);}
                             ]);
            return response(['message'=>'Articulos y precios recuperados correctamente', 'type'=>'success', 'articulos'=>$articulos]);
        }catch(\Exception $e){
            report($e);
            return response(['message'=>'Ocurrion un error al recuperar los articulos con sus precios', 'type'=>'error', 'error'=>$e->getMessage()]);
        }
    }
}
