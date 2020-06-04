<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Model;

class Cliente_empresa extends Model
{
    protected $connection = 'DDBBclientes';
    protected $table = 'cliente_empresas';

    public function clientes()
    {
        return $this->hasMany('App\Models\Ventas\Cliente_empresa', 'cliente_empresa_id');
    }
}
