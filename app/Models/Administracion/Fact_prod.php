<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
class Fact_prod extends Model
{
  protected $table = 'facturas';

  protected $fillable = [
    'factura_id', 'cantidad', 'detalle', 'iva_id', 'valor_unitario', 'subtotal'
  ];

  public function factura() {
    return $this->belongsTo('App\Models\Administracion\Factura');
  }
}
