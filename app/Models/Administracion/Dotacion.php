<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dotacion extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'dotacion';

  protected $fillable = [
    'empresa_id', 'dotacion', 'status',
  ];

  protected $attribute = [
    'status' => 0,
  ];
}
