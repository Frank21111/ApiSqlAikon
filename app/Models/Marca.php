<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'MARCA';

    protected $hidden = [
         'MA_FECHAMODIF'
    ];

    public $incrementing = false;
    
    protected $keyType = 'string';

    public $primaryKey = 'MA_CODIGO';

    public $timestamps = false;
}
