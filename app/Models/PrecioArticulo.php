<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrecioArticulo extends Model
{
    protected $table = 'ART_PRE';

    protected $fillable = [
         'AR_CODIGO'
        ,'LP_CODIGO'
        ,'AP_PRECIO'
        ,'AP_UTILID'];
    
    protected $hidden = [
        'AP_PRESUG'
        ,'AG_CODIGO'
        ,'AP_COMVEND'
        ,'AP_FECMOD'
        ,'AP_DESCRIPCION'
        ,'AP_NEWPRECIO'
        ,'AP_NEWFECHA'
        ,'rowguid'
        
    ];
  
    protected $keyType = 'string';
    
    public $incrementing = false;

    public $primaryKey = 'AR_CODIGO';

    public $timestamps = false;

}
