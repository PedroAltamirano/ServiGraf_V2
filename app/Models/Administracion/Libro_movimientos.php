<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;

use App\Models\Administracion\Libro_ref;
use App\Models\Administracion\Banco;

class Libro_movimientos extends Model
{
  protected $table = 'libro_movimientos';

  protected $fillable = [
    'usuario_id', 'libro_id', 'tipo', 'libro_ref_id', 'fecha', 'beneficiario', 'ci', 'detalle', 'ingreso', 'egreso', 'banco_id', 'cuenta', 'cheque'
  ];

  public $attributes = [
  ];

  public function referencia() {
    return $this->belongsTo(Libro_ref::class, 'libro_ref_id');
  }

  public function banco(){
    return $this->belongsTo(Banco::class);
  }
}
