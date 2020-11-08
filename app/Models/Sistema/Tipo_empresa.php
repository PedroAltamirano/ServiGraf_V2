<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Model;

class Tipo_empresa extends Model
{
    protected $table = 'tipo_empresa';

    public function empresas(){
        return $this->hasMany('App\Models\Sistema\Empresas');
    }
}
