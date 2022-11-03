<?php

namespace App\Models;
use App\Models\Stock;
use App\Models\ArticuloComprobante;
use App\Models\PrecioArticulo;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table  = 'ARTICULO';

    protected $hidden = [
          'FA_CODIGO'
          ,'UM_CODIGO'
          ,'AR_MEMO'
          ,'AR_DESCUE'
          ,'AR_FECPRE'
          ,'AR_DESSTO'
          ,'AR_TIEMPO'
          ,'II_CODIGO'
          ,'AR_PESO'
          ,'TIA_CODIGO'
          ,'PL_CODVEN'
          ,'PL_CODCOM'
          ,'AR_EXENTO'
          ,'AR_ADI01'
          ,'AR_ADI02'
          ,'AR_ADI03'
          ,'AR_COSBRU'
          ,'AR_COSNET'
          ,'MA_CODIGO'
          ,'AR_IMAGEN'
          ,'RE1_CODIGO'
          ,'RE2_CODIGO'
          ,'AR_CANENV'
          ,'AR_DESCRIL2'
          ,'AR_DESCRIL3'
          ,'AR_DESCRIL4'
          ,'ALI_CODVEN'
          ,'ALI_CODCOM'
          ,'DE_CODIGO'
          ,'CVE_CODIGO'
          ,'ALP_CODIGO'
          ,'AR_IMPETIQ'
          ,'ESA_CODIGO'
          ,'UM_CODCOM'
          ,'AR_EQUUM'
          ,'AR_FECHAALTA'
          ,'RUM_MAYOR'
          ,'RUM_MINOR'
          ,'AR_TAMANO'
          ,'AR_ALTO'
          ,'AR_ANCHO'
          ,'AR_PROFUNDO'
          ,'AR_COLOR'
          ,'AR_PRESUG'
          ,'AR_UNICAJ'
          ,'II_CODIGO2'
          ,'AR_IIFIJO'
          ,'AR_DESMAX'
          ,'AR_OFERTA'
          ,'MO_CODIGO'
          ,'AR_DESCRIA'
          ,'AR_CODREARC'
          ,'AR_CODREINT'
          ,'AR_COSREP'
          ,'AR_COSUCP'
          ,'AR_EXEP_DESDOBLE'
          ,'AR_MINIMAVTA'
          ,'AR_FECHAMODIF'
          ,'AR_LITROS'
          ,'AR_RENTMIN'
          ,'AR_RENTMAX'
          ,'AR_UMEXACTA'
          ,'PR_CODIGO'
          ,'AR_FECUCP'
          ,'AR_ESDEVENTAS'
          ,'AR_ESDECOMPRAS'
          ,'AR_IMPIIF'
          ,'AR_PORPARTGAS'
          ,'AR_PORUTILCOS'
          ,'AR_DURPROD'
          ,'AR_UNAPRODUCIR'
          ,'AR_MANZANA'
          ,'AR_LOTE'
          ,'AR_SUPERFICIE'
          ,'AR_MAILING'
          ,'AR_PORCENTAJECIF'
          ,'AR_APLICAFLETE'
          ,'AR_CODIGONUEVO'
          ,'AR_MESESGARANTIA'
          ,'AIB_CODIGO'
          ,'AR_COBERTURA'
          ,'AR_PUBLICARWEB'
          ,'AR_SERIALIZABLE'
          ,'AR_USAENVASES'
          ,'CT_CODIGO'
          ,'AR_PRIORIDAD'
          ,'AR_ECOMMERCE'
          ,'rowguid'
    ];

    public $incrementing = false;
    
    protected $keyType = 'string';

    public $primaryKey = 'AR_CODIGO';

    public $timestamps = false;

    protected $casts = [
      'AR_CODIGO' => 'string',
    ];

    protected $fillable = [
      'AR_CODIGO'
      ,'AR_DESCRI'
      ,'AR_BARRAS' 
      ,'FA_CODIGO'
      ,'MA_CODIGO'
      ,'ESA_CODIGO'
    ];

    public function stock(){
      return $this->hasMany(Stock::class, 'AR_CODIGO', 'AR_CODIGO');
    }

    public function familia(){
      return $this->hasOne(Familia::class, 'FA_CODIGO', 'FA_CODIGO');
    }

    public function marca(){
      return $this->hasOne(Marca::class, 'MA_CODIGO', 'MA_CODIGO');
    }

    public function comprobantes(){
      return $this->hasMany(ArticuloComprobante::class, 'AR_CODIGO', 'AR_CODIGO');
    }

    public function precios(){
      return $this->hasMany(PrecioArticulo::class, 'AR_CODIGO', 'AR_CODIGO');
    }

    public function scopeDisponible($query){
      return $query->where('ESA_CODIGO', 1);
    }
    
    public function scopeActivo($query){
      return $query->where('ESA_CODIGO', 2);
    }
    
    public function scopeInactivo($query){
      return $query->where('ESA_CODIGO', 3);
    }
}
