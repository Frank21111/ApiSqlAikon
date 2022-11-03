<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListaPrecio extends Model
{
    protected $table = 'LISTA_PRECIO';

    protected $hidden = [
         'LP_FECACT'
        ,'LP_FECVIG'
        ,'LP_PVCONSULTA'
        ,'LP_VERCOLCONSART'
        ,'LP_FECHAMODIF'
    ];

      
}
