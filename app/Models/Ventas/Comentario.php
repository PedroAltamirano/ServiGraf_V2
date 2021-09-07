<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Comentario extends Model
{
  use HasFactory, NodeTrait;
  protected $table = 'comentarios';
}
