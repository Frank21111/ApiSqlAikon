<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index(){
        try{
            $marcas = Marca::get();
            return response(['marcas'=>$marcas, 'message'=>'Marcas recuperadas exitosamente', 'type'=>'success']);

        }catch(\Exception $e){
            return response(['message'=>'Ocurrion un error al buscar las marcas', 'type'=>'error']);
        }
    }
}
