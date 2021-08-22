<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Cliente extends Model
{
    protected $table = 'clientes';

    public $attributes =[
      'seguimiento' => 0
    ];

    protected $fillable = [
      'empresa_id', 'usuario_id', 'contacto_id', 'cliente_empresa_id', 'seguimiento'
    ];

    protected $hidden = [
      'created_at', 'updated_at'
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

    public function full_name(){
      return $this->contacto->nombre.' '.$this->contacto->apellido;
    }

    public function bussiness_name(){
      return $this->empresa->nombre.' / '.$this->contacto->nombre.' '.$this->contacto->apellido;
    }
}
