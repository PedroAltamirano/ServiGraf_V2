<?php

namespace App\Models\Sistema;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Usuarios\Usuario;
use App\Models\Administracion\Horario;
use App\Models\Administracion\NominaDocs;
use App\Models\Administracion\NominaDotacion;
use App\Models\Administracion\NominaEducacion;
use App\Models\Administracion\NominaFamilia;
use App\Models\Administracion\NominaReferencia;

class Nomina extends Model
{
  use SoftDeletes;

  protected $table = 'nomina';
  protected $primaryKey = 'cedula';
  public $incrementing = false;

  protected $attributes = [
    'idioma_nativo' => 'Español', 'visita_domiciliaria' => 0, 'iess_asumido_empleador' => 0, 'liquidacion_mensual' => 1, 'status' => 1, 'Txhoras' => 0
  ];

  protected $fillable = [
    'empresa_id', 'cedula', 'foto', 'fecha_nacimiento', 'lugar_nacimiento', 'nacionalidad', 'estado_civil', 'genero', 'idioma_nativo', 'nombre', 'apellido', 'telefono', 'celular', 'correo', 'cant_hijos', 'direccion', 'sector', 'visita_domiciliaria', 'fecha_visita',

    'inicio_labor', 'fin_labor', 'cargo', 'sueldo', 'status', 'centro_costos_id', 'ingreso_iess', 'iess_asumido_empleador', 'liquidacion_mensual', 'Txhoras', 'horario_id', 'observaciones', 'banco_id', 'tipo_cuenta_banco', 'numero_cuenta_bancaria',

    'contacto_emergencia_nombre', 'contacto_emergencia_domicilio', 'contacto_emergencia_celular', 'contacto_emergencia_oficina', 'tipo_sangre', 'padecimientos_medicos', 'alergias'
  ];

  protected $hidden = [
    'empresa_id', 'visita_domiciliaria', 'fecha_visita', 'ingreso_iess'
  ];

  public function usuario()
  {
    return $this->hasOne('App\Models\Usuarios\Usuario', 'cedula');
  }

  public static function todos()
  {
    return Nomina::where('empresa_id', Auth::user()->empresa_id)->select('nombre', 'apellido', 'cedula')->get();
  }

  public static function availables()
  {
    $user = Auth::user();
    $usuarios = Usuario::where('empresa_id', $user->empresa_id)->get();
    $nomina = Nomina::where('empresa_id', $user->empresa_id)->select('nombre', 'apellido', 'cedula')->get();

    return $nomina->diff($usuarios);
  }

  public function getNombreCompletoAttribute()
  {
    return $this->nombre . ' ' . $this->apellido;
  }

  public function getMovilAttribute()
  {
    $res = $this->telefono;
    if ($res != '') {
      $res .= ' / ';
    }
    $res .= $this->celular;
    return $res;
  }

  /**
   * Get all of the documentos for the Nomina
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function documentos()
  {
    return $this->hasOne(NominaDocs::class, 'nomina_id', 'cedula');
  }

  /**
   * Get all of the educacion for the Nomina
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function educacion()
  {
    return $this->hasMany(NominaEducacion::class, 'nomina_id', 'cedula');
  }

  /**
   * Get all of the dotacion for the Nomina
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function dotacion()
  {
    return $this->hasMany(NominaDotacion::class, 'nomina_id', 'cedula');
  }

  /**
   * Get all of the familiares for the Nomina
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function familiares()
  {
    return $this->hasMany(NominaFamilia::class, 'nomina_id', 'cedula');
  }

  /**
   * Get all of the referencias for the Nomina
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function referencias()
  {
    return $this->hasMany(NominaReferencia::class, 'nomina_id', 'cedula');
  }

  /**
   * Get all of the horario for the Nomina
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function horario()
  {
    return $this->belongsTo(Horario::class);
  }

  /**
   * Get all of the horario for the Nomina
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function getHorarioRangeAttribute()
  {
    $horario = $this->horario;
    if ($horario == null) return null;

    $llegada_ma_1 = (new Carbon($horario->llegada_ma))->subMinutes($horario->espera)->format('H:i:s');
    $salida_ma_1 = (new Carbon($horario->salida_ma))->subMinutes($horario->espera)->format('H:i:s');
    $llegada_ta_1 = (new Carbon($horario->llegada_ta))->subMinutes($horario->espera)->format('H:i:s');
    $salida_ta_1 = (new Carbon($horario->salida_ta))->subMinutes($horario->espera)->format('H:i:s');

    $llegada_ma_2 = (new Carbon($horario->llegada_ma))->addMinutes($horario->espera)->addMinutes($horario->gracia)->format('H:i:s');
    $salida_ma_2 = (new Carbon($horario->salida_ma))->addMinutes($horario->espera)->addMinutes($horario->gracia)->format('H:i:s');
    $llegada_ta_2 = (new Carbon($horario->llegada_ta))->addMinutes($horario->espera)->addMinutes($horario->gracia)->format('H:i:s');
    $salida_ta_2 = (new Carbon($horario->salida_ta))->addMinutes($horario->espera)->addMinutes($horario->gracia)->format('H:i:s');

    $horario->llegada_ma = [$llegada_ma_1, $llegada_ma_2];
    $horario->salida_ma = [$salida_ma_1, $salida_ma_2];
    $horario->llegada_ta = [$llegada_ta_1, $llegada_ta_2];
    $horario->salida_ta = [$salida_ta_1, $salida_ta_2];

    return $horario;
  }

  public function getAvatarAttribute()
  {
    if ($this->foto) return asset("avatars/$this->foto");
    return false;
  }
}
