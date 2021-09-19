<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FacturaPedido extends Pivot
{
  use HasFactory, SoftDeletes;

  protected $table = 'factura_ots';

  protected $fillable = [
    'factura_id', 'pedido_id'
  ];
}
