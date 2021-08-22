<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Model;
use Auth;

use App\Models\Ventas\Contacto;
use App\Models\Ventas\Cliente_empresa;
use App\Models\Produccion\Pedido;

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
      return $this->belongsTo(Contacto::class);
    }

    function empresa()
    {
      return $this->belongsTo(Cliente_empresa::class, 'cliente_empresa_id');
    }

    public function pedidos()
    {
      return $this->hasMany(Pedido::class, 'cliente_id');
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
