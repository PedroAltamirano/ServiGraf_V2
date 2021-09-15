<?php

namespace App\Http\Controllers\Administracion;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
  public function marcar()
  {
    $asistencia = Asistencia::where('empresa_id', Auth::user()->empresa_id)->where('usuario_id', Auth::id())->where('fecha', date('Y-m-d'))->first();
    $validated = [];
    DB::beginTransaction();
    try {
      if (!$asistencia) {
        $validated['empresa_id'] = Auth::user()->empresa_id;
        $validated['usuario_id'] = Auth::id();
        $validated['fecha'] = date('Y-m-d');
        $validated['llegada_mañana'] = date('H:i:s');
        if ($asistencia = Asistencia::create($validated)) {
          DB::commit();
          Alert::success('Acción completada', 'Asistencia creada con éxito');
          return redirect()->back();
        }
      } else {
        if ($asistencia->llegada_mañana && !$asistencia->salida_mañana) $validated['salida_mañana'] = date('H:i:s');
        if ($asistencia->salida_mañana && !$asistencia->llegada_tarde) $validated['llegada_tarde'] = date('H:i:s');
        if ($asistencia->llegada_tarde && !$asistencia->salida_tarde) $validated['salida_tarde'] = date('H:i:s');
        $horas = $this->manageHoras($asistencia->llegada_mañana, $asistencia->salida_mañana, $asistencia->llegada_tarde, $asistencia->salida_tarde);
        $validated['total'] = $horas['total'];
        $validated['extras'] = $horas['extras'];

        if ($asistencia->update($validated)) {
          DB::commit();
          Alert::success('Acción completada', 'Asistencia modificada con éxito');
          return redirect()->back();
        }
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Asistencia no guardada');
      return redirect()->back()->withInput();
    }
  }

  /*
   * Store a newly created resource in storage.
   *
   * @param  App\Http\Requests\Administracion\StoreAsistencia  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreAsistencia $request)
  {
    $validated = $request->validated();
    $validated['empresa_id'] = Auth::user()->empresa_id;
    $validated['usuario_id'] = Auth::id();
    $horas = $this->manageHoras($validated['llegada_mañana'], $validated['salida_mañana'], $validated['llegada_tarde'], $validated['salida_tarde']);
    $validated['total'] = $horas['total'];
    $validated['extras'] = $horas['extras'];


    DB::beginTransaction();
    try {
      if ($asistencia = Asistencia::create($validated)) {
        DB::commit();
        session()->put('asistencia', $asistencia->id);
        Alert::success('Acción completada', 'Asistencia creada con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Asistencia no creada');
      return redirect()->back()->withInput();
    }
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
    $horas = $this->manageHoras($validated['llegada_mañana'], $validated['salida_mañana'], $validated['llegada_tarde'], $validated['salida_tarde']);
    $validated['total'] = $horas['total'];
    $validated['extras'] = $horas['extras'];

    DB::beginTransaction();
    try {
      if ($asistencia->update($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Asistencia modificada con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Asistencia no modificada');
      return redirect()->back()->withInput();
    }
  }

  public function manageHoras($llegada_ma = null, $salida_ma = null, $llegada_ta = null, $salida_ta = null)
  {
    $llegada_ma = new Carbon($llegada_ma);
    $salida_ma = new Carbon($salida_ma);
    $llegada_ta = new Carbon($llegada_ta);
    $salida_ta = new Carbon($salida_ta);

    $horas_ma = ($llegada_ma && $salida_ma) ? $salida_ma->diffInSeconds($llegada_ma) : 0;
    $horas_ta = ($llegada_ta && $salida_ta) ? $salida_ta->diffInSeconds($llegada_ta) : 0;
    $total = $horas_ma + $horas_ta;
    $extras = $total - (8 * 3600);
    $extras = $extras > 0 ? $extras : 0;

    // $validated['total'] = gmdate('H:i:s', ($total - $extras));
    // $validated['extras'] = gmdate('H:i:s', $extras);
    return ['total' => gmdate('H:i:s', ($total - $extras)), 'extras' => gmdate('H:i:s', $extras)];
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  App\Models\Administracion\Asistencia  $asistencia
   * @return \Illuminate\Http\Response
   */
  public function destroy(Asistencia $asistencia)
  {
    DB::beginTransaction();
    try {
      if ($asistencia->delete()) {
        DB::commit();
        Alert::success('Acción completada', 'Asistencia eliminada con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Asistencia no eliminada');
      return redirect()->back();
    }
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
