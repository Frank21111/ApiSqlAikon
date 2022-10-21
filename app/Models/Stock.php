<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'STOCK';

    protected $visible = [
        'ST_STOCK'
        ,'DE_CODIGO' 
        ,'AR_CODIGO' 
    ];

}
