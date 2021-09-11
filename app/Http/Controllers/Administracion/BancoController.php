<?php

namespace App\Http\Controllers\Administracion;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Administracion\Banco;

use App\HTTP\Requests\Administracion\StoreBanco;
use App\HTTP\Requests\Administracion\UpdateBanco;

class BancoController extends Controller
{
  use SoftDeletes;

  /**
   * Store a newly created resource in storage.
   *
   * @param  App\Http\Requests\Administracion\StoreBanco $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreBanco $request)
  {
    $validated = $request->validated();
    $validated['empresa_id'] = Auth::user()->empresa_id;
    $validated['usuario_id'] = Auth::id();

    DB::beginTransaction();
    try {
      if ($banco = Banco::create($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Banco creado con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Banco no creado');
      return redirect()->back()->withInput();
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  App\Http\Requests\Administracion\UpdateBanco $request
   * @param  App\Models\Administracion\Banco $banco
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateBanco $request, Banco $banco)
  {
    $validated = $request->validated();

    DB::beginTransaction();
    try {
      if ($banco->update($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Banco modificado con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Banco no modificado');
      return redirect()->back()->withInput();
    }
  }
}
