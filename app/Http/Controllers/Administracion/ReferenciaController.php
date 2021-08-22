<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Administracion\Libro_ref;

use App\HTTP\Requests\Administracion\StoreReferencia;
use App\HTTP\Requests\Administracion\UpdateReferencia;

class ReferenciaController extends Controller
{
  use SoftDeletes;

  /**
   * Store a newly created resource in storage.
   *
   * @param  App\Http\Requests\Administracion\StoreReferencia  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreReferencia $request)
  {
    $validated = $request->validated();
    $validated['empresa_id'] = Auth::user()->empresa_id;
    $validated['usuario_id'] = Auth::id();
    $libro_ref = Libro_ref::create($validated);

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
   * @param  App\Http\Requests\Administracion\UpdateReferencia  $request
   * @param  App\Models\Administracion\Libro_ref  $libro
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateReferencia $request, Libro_ref $libro_ref)
  {
    $validated = $request->validated();
    $libro_ref->update($validated);

    $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'La referencia se ha modificado con éxito'
    ];
    Alert::success('Acción completada', 'La área se ha modificado con éxito');
    return redirect()->back()->with(['actionStatus' => json_encode($data)]);
  }
}
