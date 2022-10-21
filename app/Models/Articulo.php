<?php

namespace App\Models;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table  = 'Articulo';

    protected $visible = [
       'AR_CODIGO'
      ,'AR_DESCRI'
      ,'AR_BARRAS'
    ];

    public function stock(){
      return $this->hasMany(Stock::class, 'AR_CODIGO', 'AR_CODIGO');
    }
}
