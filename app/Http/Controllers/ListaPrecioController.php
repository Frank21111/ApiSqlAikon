<?php

namespace App\Http\Controllers;

use App\Models\ListaPrecio;
use Illuminate\Http\Request;

class ListaPrecioController extends Controller
{
    public function index(){
        try{
            $listas = ListaPrecio::get();
            return response(['listas'=>$listas, 'message'=>'Listas de precio recuperadas exitosamente', 'type'=>'success']);

        }catch(\Exception $e){
            return response(['message'=>'Ocurrion un error al buscar las listas de precio', 'type'=>'error']);
        }
    }
}
