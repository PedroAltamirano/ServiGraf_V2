<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Sistema\Horario;

use App\Http\Requests\Sistema\StoreHorario;
use App\Http\Requests\Sistema\UpdateHorario;

class HorariosController extends Controller
{
  use SoftDeletes;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
  }

  /**
   * Show pedidos dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function show()
  {
    $horarios = Horario::where('empresa_id', Auth::user()->empresa_id)->get();
    return view('Sistema.horarios', compact('horarios'));
  }

  // crear nuevo
  public function store(StoreHorario $request)
  {
    $validator = $request->validated();
    $validator['empresa_id'] = Auth::user()->empresa_id;
    $horario = Horario::create($validator);

    Alert::success('Acción completada', 'Horario creado con éxito');
    return redirect()->back();
  }

  //modificar perfil
  public function update(UpdateHorario $request, Horario $horario)
  {
    $validator = $request->validated();
    $horario->update($validator);

    Alert::success('Acción completada', 'Horario modificado con éxito');
    return redirect()->back();
  }
}
