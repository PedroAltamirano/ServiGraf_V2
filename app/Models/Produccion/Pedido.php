<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;
use Auth; 
use Illuminate\Support\Facades\DB;
use App\Models\Produccion\Pedido_servicio;
use App\Models\Produccion\Servicio;
use App\Models\Produccion\Sub_servicio;

class Pedido extends Model
{
    protected $connection = 'DDBBproduccion';
    protected $table = 'pedidos';
    public $incrementing = false;
  
    public $attributes =[
        'total_material' => 0.00
    ];
  
    protected $fillable = [
        'usuario_mod_id', 'usuario_cobro_id', 'cliente_id', 'id', 'fecha_entrada', 'fecha_salida', 'prioridad', 'estado', 'fecha_cobro', 'detalle', 'papel', 'cantidad', 'corte_alto', 'corte_ancho', 'numerado_inicio', 'numerado_fin', 'total_material', 'total_pedido', 'abono', 'saldo', 'notas'
    ];
  
    protected $hidden = [
        'created_at', 'updated_at', 'empresa_id', 'usuario_id'
    ];
  
    protected $casts = [
    ];

    /*
    * @return Orden_produccion con servicios incompletos
    */

    public function cliente()
    {
        return $this->belongsTo('App\Models\Ventas\Cliente', 'cliente_id');
    }

    public function material()
    {
        return $this->hasMany('App\Models\Produccion\Solicitud_material');
    }

    public function servicios()
    {
        return $this->hasMany('App\Models\Produccion\Pedido_servicio');
    }

    public function tintas()
    {
        return $this->hasMany('App\Models\Produccion\Pedido_tintas');
    }

    public function abonos()
    {
        return $this->hasMany('App\Models\Produccion\Abono');
    }

    /**
     * @return App\Model\Produccion\Pedido que no esten terminados
     */
    public static function incompletas()
    {
        $incompletos = Pedido_servicio::where([['empresa_id', '=', Auth::user()->empresa_id], ['status', '=', '0']])
                                        ->groupBy('pedido_id')
                                        ->select('pedido_id')
                                        ->get();
        $pedidos_inc = [];
        foreach ($incompletos as $e){
            $pedidos_inc[] = $e->pedido_id;
        }
        
        return Pedido::whereIn('id', $pedidos_inc)->where('estado',  '!=', '3')->select('id', 'numero', 'cliente_id', 'detalle', 'cantidad')->get();
    }

    /*
    * @return lista con todos los servicios sin terminar
    */
    public static function serviciosIncompletos($pedido_id)
    {
        $OS = Pedido_servicio::where('pedido_id', strval($pedido_id))->get();
        $list = [];
        foreach ($OS as $servicio) {
            $serv = Servicio::where('id', $servicio->servicio_id)->value('servicio');
            if($servicio->subservicio_id != null){
                $serv = $serv.'-';
                $serv = $serv.Sub_servicio::where('id', $servicio->subservicio_id)->value('subservicio');
            }
            $list[] = $serv;
        }
        return $list;
    }

    /*
    * @return lista con todos los servicios sin terminar
    */
    public static function todos()
    {
        $incompletas = Pedido::incompletas();
        $list = [];
        foreach ($incompletas as $pedido){
            $temp = [];
            $cli = $pedido->cliente;
            $temp['numero'] = $pedido->numero;
            $temp['detalle'] = $pedido->detalle;
            $temp['cantidad'] = $pedido->cantidad;
            $temp['servicios'] = $pedido->serviciosIncompletos($pedido->id);
            $temp['cliente'] = $cli->empresa->nombre.' / '.$cli->contacto->nombre.' '.$cli->contacto->apellido;
            $list[] = $temp;
        }
        return $list;
    }

    public static function reporteAreas($id){
        return Pedido_servicio::where('pedido_id', $id)->join('servicios', 'pedido_servicios.servicio_id' ,'=', 'servicios.id')->select('area_id', DB::raw('sum(total) as totalArea'))->groupBy('area_id')->get()->toArray();
    }
    
    // public function material()
    // {
    //     return $this->belongsTo('App\Models\Ventas\Cliente');
    // }

    // public function abonos()
    // {
    //     return $this->belongsTo('App\Models\Ventas\Cliente');
    // }
}
