<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Support\Facades\DB;
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
   * @param  App\Http\Requests\Administracion\StoreBanco  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreBanco $request)
  {
    $validated = $request->validated();
    $validated['empresa_id'] = Auth::user()->empresa_id;
    $validated['usuario_id'] = Auth::id();
    $libro_ref = Banco::create($validated);

    Alert::success('Acción completada', 'Banco creado con éxito');
    return redirect()->back();
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  App\Http\Requests\Administracion\UpdateBanco  $request
   * @param  App\Models\Administracion\Libro_ref  $libro
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateBanco $request, Banco $banco)
  {
    $validated = $request->validated();
    $banco->update($validated);

    Alert::success('Acción completada', 'Banco modificado con éxito');
    return redirect()->back();
  }
}
