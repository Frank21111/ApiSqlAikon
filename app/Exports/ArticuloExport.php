<?php
namespace App\Exports;
use App\Models\Articulo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Builder;

class ArticuloExport implements FromCollection{
    
        private $fecha;
        private $stockCero;

        public function __construct($fecha, $stockCero) 
        {
            $this->fecha = $fecha;
        }
    
      public function collection(){
        //   if($this->stockCero)
            $sinVentas = Articulo::disponible()
                                    ->whereDoesntHave('comprobantes', function (Builder $query){
                                        $query->where('MM_CODCOM', 'FAR')->where('MM_FECHA', '>', $this->fecha .'T00:00:00');})
                                    ->whereHas('stock', function (Builder $query){
                                        $query->havingRaw('SUM(ST_STOCK) = 0');})
                                    ->whereHas('marca', function (Builder $query){
                                        $query->where('MA_CODIGO', '!=' , 930);})
                                    ->get(['AR_CODIGO'
                                    ,'AR_DESCRI'
                                    ,'AR_BARRAS']);
        //   else
        //     $sinVentas = []
            return $sinVentas;
      }
}