<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Administracion\Factura;

class FactProd extends Model
{
  // use SoftDeletes;

  protected $table = 'fact_prods';

  protected $fillable = [
    'factura_id', 'cantidad', 'detalle', 'iva_id', 'valor_unitario', 'subtotal'
  ];

  public function factura()
  {
    return $this->belongsTo(Factura::class);
  }
}
