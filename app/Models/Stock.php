<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'STOCK';

    protected $hidden = [
         'ST_ADI02'
        ,'ST_ADI01'
        ,'ST_UBICAC'
        ,'ST_COMPRO'
        ,'ST_ANTES'
        ,'ST_RESERVA'
    ];

    protected $fillable = [
        'ST_MINIMO'
        ,'ST_MAXIMO'
    ];

    protected $primaryKey = 'AR_CODIGO';

    public $timestamps = false;

}
