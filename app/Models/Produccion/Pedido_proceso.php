<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido_proceso extends Model
{
  // use SoftDeletes;

  protected $table = 'pedido_proceso';

  public $attributes = [
    'status' => 0
  ];

  protected $fillable = [
    'proceso_id', 'subproceso_id', 'tiro', 'retiro', 'millares', 'valor_unitario', 'total', 'status'
  ];

  protected $hidden = [
    'created_at', 'updated_at', 'ot_id'
  ];

  function pedido()
  {
    return $this->belongsTo(Pedido::class);
  }

  function proceso()
  {
    return $this->belongsTo(Proceso::class);
  }
}
