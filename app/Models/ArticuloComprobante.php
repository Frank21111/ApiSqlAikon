<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Articulo;

class ArticuloComprobante extends Model
{
    protected $table = 'MOVI_MAT';

    protected $fillable = [
                    'MM_NUMERO'
                    ,'MM_TIPRES'
                    ,'DE_CODIGO'
                    ,'MM_CODCOM'
                    ,'MM_SUCCOM'
                    ,'MM_NUMCOM'
                    ,'MM_TIPCOM'
                    ,'AR_CODIGO'
                    ,'MM_CANTID'
                    ,'ST_COLOR'
                    ,'MM_CODRES'
                    ,'MM_NOMRES'
                    ,'MM_ACTSTO'
                    ,'MM_CAUSA'
                    ,'MM_FECHA'
                    ,'MM_HORA'
                    ,'ST_TALLE'
                    ,'MM_ENTSAL'
                    ,'EM_CODIGO'
                    ,'ST_ANTES'
                    ];

    public function articulo(){
        return $this->hasOne(Articulo::class, 'AR_CODIGO', 'AR_CODIGO');
    }
}
