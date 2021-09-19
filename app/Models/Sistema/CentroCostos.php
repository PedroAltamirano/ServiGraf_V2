<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

class CentroCostos extends Model
{
  use SoftDeletes;
  // use HasFactory;

  protected $table = 'centro_costos';

  protected $fillable = [
    'empresa_id', 'nombre'
  ];
}
