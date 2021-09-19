<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Sistema\Empresas;

class Tipo_empresa extends Model
{
  use SoftDeletes;

  protected $table = 'tipo_empresa';

  public function empresas()
  {
    return $this->hasMany(Empresas::class);
  }
}
