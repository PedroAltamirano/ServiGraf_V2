<?php

namespace App\Http\Controllers\Sistema;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Sistema\Nomina;
use App\Models\Usuarios\Perfil;
use App\Models\Sistema\Empresas;
use App\Models\Usuarios\Usuario;
use App\Models\Sistema\CentroCostos;
use App\Models\Sistema\Tipo_empresa;
use App\Models\Administracion\Horario;

use App\Http\Requests\Sistema\StoreEmpresaAdmin;
use App\Http\Requests\Sistema\UpdateEmpresaAdmin;

class EmpresasController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('isSuperAdmin');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $empresas = Empresas::with(['tipo_empresa', 'root'])->get();
    $tipos = Tipo_empresa::all();
    return view('Sistema.Admin.empresas', compact('empresas', 'tipos'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\StoreEmpresaAdmin  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreEmpresaAdmin $request)
  {
    $validated = $request->validated();

    DB::beginTransaction();
    try {
      if ($empresa = Empresas::create(Arr::only($validated, ['id', 'nombre', 'tipo_empresa_id', 'status']))) {
        $horario_id = $this->create_horario($empresa->id);
        $this->create_centro_costos($empresa->id);
        $perfil_id = $this->create_perfil($empresa->id);
        $this->create_nomina($empresa->id, $validated, $horario_id);
        $this->create_usuario($empresa->id, $validated, $perfil_id);

        DB::commit();
        Alert::success('Acción completada', 'Empresa creada con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Empresa no creada');
      return redirect()->back()->withInput();
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\UpdateEmpresaAdmin  $request
   * @param  Empresas $empresa
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateEmpresaAdmin $request, Empresas $empresa)
  {
    $validated = $request->validated();
    $validated['status'] = $validated['status'] ?? 0;

    DB::beginTransaction();
    try {
      if ($empresa->update($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Empresa modificada con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Empresa no modificada');
      return redirect()->back()->withInput();
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Empresas $empresa
   * @return \Illuminate\Http\Response
   */
  public function destroy(Empresas $empresa)
  {
    DB::beginTransaction();
    try {
      if ($empresa->delete()) {
        DB::commit();
        Alert::success('Acción completada', 'Empresa eliminada con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Empresa no eliminada');
      return redirect()->back()->withInput();
    }
  }

  private function create_horario($empresa_id)
  {
    $model = new Horario();
    $model->empresa_id = $empresa_id;
    $model->nombre = 'Matutino';
    $model->llegada_ma = '09:00';
    $model->salida_ma = '13:00';
    $model->llegada_ta = '14:00';
    $model->salida_ta = '18:00';
    $model->save();

    return $model->id;
  }

  private function create_centro_costos($empresa_id)
  {
    $model = new CentroCostos();
    $model->empresa_id = $empresa_id;
    $model->nombre = 'Centro de costos test';
    $model->save();

    return $model->id;
  }

  private function create_perfil($empresa_id)
  {
    $model = new Perfil();
    $model->empresa_id = $empresa_id;
    $model->nombre = 'RootPerf';
    $model->descripcion = 'Perfil de desarrollo';
    $model->save();

    return $model->id;
  }

  private function create_nomina($empresa_id, $request, $horario_id)
  {
    $model = new Nomina();
    $model->empresa_id = $empresa_id;
    $model->cedula = $request['cedula'];
    $model->fecha_nacimiento = date('Y-m-d');
    $model->lugar_nacimiento = 'Quito';
    $model->nacionalidad = 'Ecuatoriano';
    $model->idioma_nativo = 'Espanol';
    $model->nombre = $request['name'];
    $model->apellido = $request['apellido'];
    $model->direccion = 'Calle principal y calle secundaria';
    $model->sector = 'Barrio';
    $model->telefono = 7777777;
    $model->celular = 999999999;
    $model->correo = $request['correo'];
    $model->tipo_sangre = 1;
    $model->genero = 1;
    $model->estado_civil = 1;
    $model->inicio_labor = date('Y-m-d');
    $model->cargo = 'Administrador';
    $model->centro_costos_id = 1;
    $model->iess_asumido_empleador = 1;
    $model->sueldo = 2000.00;
    $model->banco_id = 0;
    $model->tipo_cuenta_banco = 0;
    $model->numero_cuenta_bancaria = 123456789;
    $model->horario_id = $horario_id;
    $model->save();

    return $model->cedula;
  }

  private function create_usuario($empresa_id, $request, $perfil_id)
  {
    $model = new Usuario();
    $model->cedula = $request['cedula'];
    $model->empresa_id = $empresa_id;
    $model->usuario = $request['usuario'];
    $model->password = Hash::make('123456');
    $model->perfil_id = $perfil_id;
    $model->save();

    return $model->cedula;
  }
}
