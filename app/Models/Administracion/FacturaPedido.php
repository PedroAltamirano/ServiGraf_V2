<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FacturaPedido extends Pivot
{
  use HasFactory;

  protected $table = 'factura_ots';

  protected $fillable = [
    'factura_id', 'pedido_id'
  ];
}
