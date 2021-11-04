<?php

namespace App\Http\Controllers\Sistema;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Sistema\Empresas;
use App\Models\Sistema\Tipo_empresa;

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
    $empresas = Empresas::with('tipo_empresa')->get();
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
      if ($empresa = Empresas::create($validated)) {
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
}
