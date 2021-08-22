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

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'La referencia se ha creado con éxito'
    ];
    Alert::success('Acción completada', 'La área se ha modificado con éxito');
    return redirect()->back()->with(['actionStatus' => json_encode($data)]);
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

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'La referencia se ha modificado con éxito'
    ];
    Alert::success('Acción completada', 'La área se ha modificado con éxito');
    return redirect()->back()->with(['actionStatus' => json_encode($data)]);
  }
}
