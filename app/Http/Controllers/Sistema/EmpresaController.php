<?php

namespace App\Http\Controllers\Sistema;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Sistema\DatosEmpresa;
use App\Models\Sistema\Fact_empr;
use App\Models\Sistema\CentroCostos;

use App\Http\Requests\Sistema\StoreEmpresa;
use App\Http\Requests\Sistema\UpdateEmpresa;

class EmpresaController extends Controller
{
  use SoftDeletes;

  public function show()
  {
    $empresa = Auth::user()->empresa->datos ?? new DatosEmpresa;
    $ccostos = CentroCostos::where('empresa_id', Auth::user()->empresa_id)->get();
    return view('Sistema.empresa', compact('empresa', 'ccostos'));
  }

  public function store(StoreEmpresa $request)
  {
    $validated = $request->validated();
    $validated['empresa_id'] = Auth::user()->empresa_id;
    $validated['usuario_id_mod'] = Auth::id();

    DB::beginTransaction();
    try {
      if ($empresa = DatosEmpresa::create($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Datos de la empresa creados con éxito');
        return redirect()->route('empresa');
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Datos de la empresa no creados');
      return redirect()->back()->withInput();
    }
  }

  public function update(UpdateEmpresa $request, DatosEmpresa $empresa)
  {
    $validated = $request->validated();

    DB::beginTransaction();
    try {
      if ($empresa->update($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Datos de la empresa modificados con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Datos de la empresa no modificados');
      return redirect()->back()->withInput();
    }
  }
}
