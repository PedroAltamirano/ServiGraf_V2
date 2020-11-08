<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Cliente extends Model
{
    protected $table = 'clientes';

    public $attributes =[
        'seguimiento' => 1
    ];

    protected $fillable = [
        'usuario_id', 'contacto_id', 'id', 'seguimiento'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'empresa_id'
    ];

    function contacto()
    {
        return $this->belongsTo('App\Models\Ventas\Contacto');
    }

    function empresa()
    {
        return $this->belongsTo('App\Models\Ventas\Cliente_empresa', 'cliente_empresa_id');
    }

    public function pedidos()
    {
        return $this->hasMany('App\Models\Produccion\Pedido', 'cliente_id');
    }

    public static function todos(){
        return Cliente::where('empresa_id', Auth::user()->empresa_id)->orderBy('cliente_empresa_id')->get();
    }
}
