<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use App\Models\Administracion\Fact_prod;
use App\Models\Ventas\Cliente;

class Factura extends Model
{
  protected $table = 'facturas';

  protected $fillable = [
    'empresa_id', 'usuario_id', 'numero', 'fact_emp_id', 'cliente_id', 'emision', 'vencimiento', 'tipo', 'estado', 'tipo_pago', 'subtotal', 'descuento_p', 'descuento', 'iva', 'iva_0', 'total', 'ret_iva_p', 'ret_iva', 'ret_fuente_p', 'ret_fuente', 'total_pagar', 'notas'
  ];

  public $attributes = [
    'tipo' => 1
  ];

  public function cliente() {
    return $this->belongsTo(Cliente::class);
  }

  public function productos() {
    return $this->hasMany(Fact_prod::class);
  }
}
