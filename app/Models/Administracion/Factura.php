<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
  protected $table = 'facturas';

  protected $fillable = [
    'empresa_id', 'usuario_id', 'numero', 'fact_emp_id', 'cliente_id', 'emision', 'vencimiento', 'tipo', 'estado', 'tipo_pago', 'subtotal', 'descuento_%', 'descuento', 'iva', 'iva_0', 'total', 'ret_iva_%', 'ret_iva', 'ret_fuente_%', 'ret_fuente', 'total_pagar', 'notas'
  ];
}
