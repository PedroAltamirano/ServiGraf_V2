<?php

use App\Models\Usuarios\Perfil;
use App\Models\Usuarios\Modulo;
use App\Models\Usuarios\ModPerfRol;
use App\Models\Usuarios\Usuario;

use App\Models\Sistema\Nomina;

use App\Models\Produccion\Pedido;
use App\Models\Produccion\Pedido_proceso;
use App\Models\Produccion\Proceso;

use App\Models\Ventas\Cliente;

use Illuminate\Support\Facades\DB;

// echo Auth::user()->empresa_id;
// echo session('ModPerfRol');
// echo session('userInfo');
// echo session('userInfo.empresa_tipo');
// echo ('10-1' < '10-4')?1:0;
// echo Auth::user();

// $perfil = Perfil::select(['perfil', 'descripcion', 'status'])->where('id', 1)->get();
// // echo $perfil;

// $modPerf = ModPerfRol::where('perfil_id', 1)->get();
// // echo $modPerf;

// $data = [];
// $perfiles = $perfil->first();
// $data['perfil'] = $perfiles->perfil;
// $data['descripcion'] = $perfiles->descripcion;
// $data['status'] = $perfiles->status?'on':'';

// foreach($modPerf as $e){
//   for($i=1; $i<=$e->rol_id; $i++){
//     $index = $e->modulo_id.'-'.$i;
//     $data[$index] = 'on';
//   }
// }

// echo json_encode($data);

// $data = DB::select('SELECT cedula, nombre, apellido, (SELECT `perfil` FROM `usuarios_v2`.perfiles WHERE `id`=`perfil_id`) as perfil FROM `empresas_v2`.nomina n JOIN `usuarios_v2`.usuarios u USING (cedula)');
// // echo json_encode($data);

// $usuarios = Usuario::join('nomina as N', 'N.cedula', '=', 'usuarios.cedula')
// ->where('N.empresa_id', 1709636664001)
// ->select(['usuarios.cedula', 'usuarios.status', 'perfil'=>Perfil::select('perfil')->whereColumn('id', 'usuarios.perfil_id'), 'N.nombre', 'N.apellido'])
// ->get();

// $nomina = Nomina::where('empresa_id', Auth::user()->empresa_id)->select('nombre', 'apellido', 'cedula')->get();

// $incompletos = Orden_proceso::where([['empresa_id', '=', Auth::user()->empresa_id], ['status', '=', '0']])->groupBy('ot_id')->select('ot_id')->get();
// $ot_inc = [];
// foreach ($incompletos as $e){
//   $ot_inc[] = $e->ot_id;
// }

// $ots = Orden_produccion::whereIn('numero', $ot_inc)->select('numero', 'cliente_id', 'detalle', 'cantidad')->get();
// echo json_encode(Orden_produccion::todos());

// $ots_serv = Orden_produccion::join('procesos', 'procesos.id', 'proceso_id')->get();

// $ot_proceso = Orden_proceso::first();
// $proceso = Orden_proceso::all();

// echo json_encode($ot_inc);
// echo json_encode(Orden_produccion::procesosIncompletos($ots->numero));
// echo $ots->cliente;
// echo $ots_serv;
// foreach ($ots as $ot) {
//   echo $ot->numero.' ';
//   foreach ($ot->procesos as $proceso) {
//     echo $proceso->proceso->proceso;
//     if
//     echo $proceso->sub_proceso;
//   }
//   echo '<br>';
// }

// echo json_encode(Pedido::incompletas());
// echo json_encode(Pedido::todos());
// echo today();
// echo now();
// echo date('m d Y');

echo json_encode(session()->all());
echo Auth::user();


// $opts_ = '<option disabled selected>Selecciona uno...</option>';
// foreach (config('') ?? [] as $key => $value) {
//   $opts_ .= "<option value='$key'>$value</option>";
// }
// $old_ = $pedido->;
// if($cnt = count(old('') ?? [])) {
//   for($i = 0; $i <optgroup $cnt; $i++){
//     $model = new \stdClass;
//     $model-> = old('')[$i];
//     $old_[] = $model;
//   }
// }
