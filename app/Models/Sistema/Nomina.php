<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuarios\Usuario;

class Nomina extends Model
{
    protected $table = 'nomina';
    protected $primaryKey = 'cedula';
    public $incrementing = false;

    protected $attributes = [
        'idioma_nativo' => 'Español', 'visita_domiciliaria' => 0, 'iess_asumido_empleador' => 0, 'liquidacion_mensual' => 1, 'status' => 1, 'Txhoras' => 0
    ];

    protected $fillable = [
        'foto', 'fecha_nacimiento', 'lugar_nacimiento', 'nacionalidad', 'idioma_nativo', 'cedula', 'nombre', 'apellido', 'direccion', 'sector', 'telefono', 'celular', 'correo', 'tipo_sangre', 'padecimientos_medicos', 'genero', 'estado_civil', 'cant_hijos', 'inicio_labor', 'fin_labor', 'cargo', 'centro_costos', 'iess_asumido_empleador', 'sueldo', 'liquidacion_mensual', 'banco_id', 'tipo_cuenta_banco', 'numero_cuenta_bancaria', 'observaciones', 'status', 'horario_id', 'Txhoras'
    ];

    protected $hidden = [
        'empresa_id', 'visita_domiciliaria', 'fecha_visita', 'ingreso_iess'
    ];

    public function usuario() {
        return $this->hasOne('App\Models\Usuarios\Usuario', 'cedula');
    }

    public static function todos(){
		    return Nomina::where('empresa_id', Auth::user()->empresa_id)->select('nombre', 'apellido', 'cedula')->get();
    }

    public static function availables(){
        $usuarios = Usuario::where('empresa_id', Auth::user()->empresa_id)->get();
		    $nomina = Nomina::where('empresa_id', Auth::user()->empresa_id)->select('nombre', 'apellido', 'cedula')->get();

        return $nomina->diff($usuarios);
    }

    public function getNombreCompletoAttribute() {
      return $this->nombre.' '.$this->apellido;
    }

    public function getMovilAttribute() {
      $res = $this->telefono;
      if($res != ''){
        $res .= ' / ';
      }
      $res .= $this->celular;
      return $res;
    }
}
