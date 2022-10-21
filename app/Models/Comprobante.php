<?php

namespace App\Models;
use App\Models\ArticuloComprobante;
use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    protected $table = 'COMPROBANTES';

    protected $fillable = [
        'CO_CODIGO'
        ,'CO_SUCURS'
        ,'CO_NUMERO'
        ,'CO_TIPO'
        ,'REP_CODIGO'
        ,'CL_CODIGO'     
        ,'CL_NOMBRE'
        ,'CO_TOTCOM'
        ,'CO_NETONOG'
        ,'CO_NETO'
        ,'OPE_CODIGO'
        ,'CO_FECVEN'
        ,'CO_FECHA'
        ,'CO_FECANU'
        ,'CO_LUGENT'
        ,'VEN_CODIGO'
        ,'COB_CODIGO'
        ,'CL_IVA'
        ,'CO_MEMO'
        ,'PO_CODIGO'
        ,'CO_LENREM'
        ,'CO_FORPAG'
        ,'CJ_CODIGO'
    ];

    public function articulosComprobante(){
        return $this->hasMany(ArticuloComprobante::class, 'MM_NUMCOM', 'CO_NUMERO')->where('MM_CODCOM', $this->CO_CODIGO)->where('MM_SUCCOM', $this->CO_SUCURS);
    }
}
