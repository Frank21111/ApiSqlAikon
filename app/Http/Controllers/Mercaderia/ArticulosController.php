<?php

namespace App\Http\Controllers\Mercaderia;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Articulo;
use Illuminate\Support\Facades\Cache;

class ArticulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $articulos = Cache::remember('articulos', 1440, function() {
                return Articulo::disponible()->get();
            });
            return response(['articulos' => $articulos,'message' => "Articulos Disponibles", 'type' => 'success']);
        }catch(\Exception $e){
            dd($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $articulo = Articulo::where('AR_CODIGO', $id)->first();
            return response(['articulo' => $articulo,'message' => "Articulo encontrado", 'type' => 'success']);
        }catch(\Exception $e){
            return response(['message' => "No se encontro el articulo", 'type' => 'error']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
