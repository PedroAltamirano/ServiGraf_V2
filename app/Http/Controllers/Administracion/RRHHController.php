<?php

namespace App\Http\Controllers\Administracion;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Usuarios\Usuario;
use App\Models\Administracion\Asistencia;

use App\Http\Requests\Administracion\StoreAsistencia;
use App\Http\Requests\Administracion\UpdateAsistencia;
use App\Http\Resources\Administracion\RRHHResource;

class RRHHController extends Controller
{
  use SoftDeletes;

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $usuarios = Usuario::where('empresa_id', Auth::user()->empresa_id)->where('libro', 1)->get();
    return view('Administracion.rrhh', compact('usuarios'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  App\Http\Requests\Administracion\StoreAsistencia  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  App\Http\Requests\Administracion\UpdateAsistencia  $request
   * @param  App\Models\Administracion\Asistencia  $asistencia
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateAsistencia $request, Asistencia $asistencia)
  {
    $validated = $request->validated();
    $stM = Carbon::parse($validated['llegada_mañana']);
    $ftM = Carbon::parse($validated['salida_mañana']);
    $stT = Carbon::parse($validated['llegada_tarde']);
    $ftT = Carbon::parse($validated['salida_tarde']);
    $tM = ($validated['llegada_mañana'] && $validated['salida_mañana']) ? $ftM->diffInSeconds($stM) : 0;
    $tT = ($validated['llegada_tarde'] && $validated['salida_tarde']) ? $ftT->diffInSeconds($stT) : 0;
    $total = $tM + $tT;
    $extras = ($total - (8 * 3600)) > 0 ? ($total - (8 * 3600)) : 0;
    $validated['total'] = gmdate('H:i:s', ($total - $extras));
    $validated['extras'] = gmdate('H:i:s', $extras);
    $asistencia->update($validated);

    Alert::success('Acción completada', 'Asistencia modificada con éxito');
    return redirect()->back();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  App\Models\Administracion\Asistencia  $asistencia
   * @return \Illuminate\Http\Response
   */
  public function destroy(Asistencia $asistencia)
  {
    $asistencia->delete();

    Alert::success('Acción completada', 'Asistencia eliminada con éxito');
    return redirect()->back();
  }

  public function api(Request $request)
  {
    $res = Asistencia::where('empresa_id', Auth::user()->empresa_id)
      ->whereBetween('fecha', [$request->fechaini, $request->fechafin])
      ->where(function ($query) use ($request) {
        if ($request->usuario != 'none') {
          $query->where('usuario_id', $request->usuario);
        }
      })->get();
    return response()->json(RRHHResource::collection($res), 200);
  }
}
