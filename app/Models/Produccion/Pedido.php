<?php

namespace App\Models\Produccion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Produccion\Pedido_proceso;
use App\Models\Produccion\Proceso;
use App\Models\Usuarios\Usuario;
use App\Models\Ventas\Cliente;

class Pedido extends Model
{
  public static $own = false;
  protected $table = 'pedidos';

  public $attributes = [
    'total_material' => 0.00
  ];

  protected $fillable = [
    'empresa_id', 'numero', 'usuario_id', 'usuario_mod_id', 'usuario_cob_id', 'cliente_id', 'fecha_entrada', 'fecha_salida', 'prioridad', 'estado', 'cotizado', 'fecha_cobro', 'detalle', 'papel', 'cantidad', 'corte_alto', 'corte_ancho', 'numerado_inicio', 'numerado_fin', 'total_material', 'total_pedido', 'abono', 'saldo', 'notas'
  ];

  protected $hidden = [
    'created_at', 'updated_at'
  ];

  protected $casts = [];

  /*
    * @return Orden_produccion con Procesos incompletos
    */

  public function user()
  {
    return $this->belongsTo(Usuario::class, 'usuario_id', 'cedula');
  }

  public function user_mod()
  {
    return $this->belongsTo(Usuario::class, 'usuario_mod_id', 'cedula');
  }

  public function user_cob()
  {
    return $this->belongsTo(Usuario::class, 'usuario_cob_id', 'cedula');
  }

  public function cliente()
  {
    return $this->belongsTo(Cliente::class, 'cliente_id');
  }

  public function material_id()
  {
    return $this->hasMany(Solicitud_material::class, 'pedido_id');
  }

  public function material()
  {
    return $this->belongsToMany(Material::class, 'solicitud_materials', 'pedido_id', 'material_id');
  }

  public function procesos_id()
  {
    return $this->hasMany(Pedido_proceso::class);
  }

  public function procesos()
  {
    return $this->belongsToMany(Proceso::class, 'pedido_proceso', 'pedido_id', 'proceso_id');
  }

  public function procesos_incompletos()
  {
    return $this->belongsToMany(Proceso::class, 'pedido_proceso', 'pedido_id', 'proceso_id')->where('status', 0);
  }

  public function tintas_id()
  {
    return $this->hasMany(Pedido_tintas::class);
  }

  public function tintas()
  {
    return $this->hasMany(Tinta::class, 'pedido_tintas', 'pedido_id', 'tinta_id');
  }

  public function abonos()
  {
    return $this->hasMany(Abono::class);
  }

  /**
   * @return App\Model\Produccion\Pedido que no esten terminados
   */
  public static function incompletas($fecha = null)
  {

    $incompletos = Pedido_proceso::where('empresa_id', auth()->user()->empresa_id)
      ->where('status', '0')
      ->groupBy('pedido_id')
      ->select('pedido_id')
      ->where(function ($query) {
        if (self::$own) {
          $own_processes = Auth::user()->procesos->pluck('id')->toArray();
          $query->whereIn('proceso_id', $own_processes);
        }
      })
      ->get()
      ->pluck('pedido_id')
      ->toArray();

    return Pedido::whereIn('id', $incompletos)->where('estado',  '!=', '3')->select('id', 'numero', 'cliente_id', 'detalle', 'cantidad')->where(function ($query) use ($fecha) {
      if ($fecha) {
        $query->whereBetween('fecha_entrada', [date('Y-m-01', strtotime($fecha)), date('Y-m-t', strtotime($fecha))]);
      }
    })->get();
  }

  /*
    * @return lista con todos los procesos sin terminar
    */
  public function getProcesosIncompletosNombreAttribute()
  {
    $pedido_procesos = $this->procesos_incompletos->pluck('proceso')->toArray();
    return $pedido_procesos;
  }

  /**
   * @return lista con todos los procesos sin terminar
   */
  public static function todos()
  {
    $incompletas = Pedido::incompletas();
    $list = [];
    foreach ($incompletas as $pedido) {
      $temp = [];
      $temp['numero'] = $pedido->numero;
      $temp['detalle'] = $pedido->detalle;
      $temp['cantidad'] = $pedido->cantidad;
      $temp['procesos'] = $pedido->procesos_incompletos_nombre;
      $temp['cliente'] = $pedido->cliente->bussiness_name;
      $list[] = $temp;
    }
    return $list;
  }

  public static function reporteAreas($id)
  {
    return Pedido_proceso::where('pedido_id', $id)->join('procesos', 'pedido_proceso.proceso_id', '=', 'procesos.id')->select('area_id', DB::raw('sum(total) as totalArea'))->groupBy('area_id')->get()->toArray();
  }
}
