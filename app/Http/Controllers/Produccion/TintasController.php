<?php

namespace App\Http\Controllers\Produccion;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Http\Requests\Produccion\StoreTinta;
use App\Http\Requests\Produccion\UpdateTinta;
use App\Models\Produccion\Tinta;

class TintasController extends Controller
{
  use SoftDeletes;

  // crear nuevo
  public function store(StoreTinta $request)
  {
    $validator = $request->validated();
    $validator['empresa_id'] = Auth::user()->empresa_id;
    // dd($validator);

    $tinta = Tinta::create($validator);

    Alert::success('Acción completada', 'Tinta creada con éxito');
    return redirect()->back();
  }

  //modificar perfil
  public function update(UpdateTinta $request, Tinta $tinta)
  {
    $validator = $request->validated();
    // dd($validator);

    $tinta->update($validator);

    Alert::success('Acción completada', 'Tinta modificada con éxito');
    return redirect()->back();
  }
}
