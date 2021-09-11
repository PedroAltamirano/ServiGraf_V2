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
use App\Models\Administracion\Libro_movimientos;
use App\Models\Administracion\Libro;
use App\Models\Administracion\Banco;
use App\Models\Administracion\Libro_ref;

use App\Http\Resources\Administracion\LibroResource;
use App\Http\Requests\Administracion\StoreLibro;
use App\Http\Requests\Administracion\UpdateLibro;

class LibroController extends Controller
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
    return view('Administracion.libros', compact('usuarios'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  App\Http\Requests\Administracion\StoreLibro  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreLibro $request)
  {
    $validated = $request->validated();
    $validated['empresa_id'] = Auth::user()->empresa_id;

    DB::beginTransaction();
    try {
      if ($libro = Libro::create($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Libro creado con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Libro no creado');
      return redirect()->back()->withInput();
    };
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  App\Http\Requests\Administracion\UpdateLibro  $request
   * @param  App\Models\Administracion\Libro  $libro
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateLibro $request, Libro $libro)
  {
    $validated = $request->validated();

    DB::beginTransaction();
    try {
      if ($libro->update($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Libro modificado con éxito');
        return redirect()->route('actividad.edit', $actividad);
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Libro no modificado');
      return redirect()->back()->withInput();
    };
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  App\Models\Administracion\  $entrada
   * @return \Illuminate\Http\Response
   */
  public function destroy(Libro $libro)
  {
    DB::beginTransaction();
    try {
      if ($libro->delete()) {
        DB::commit();
        Alert::success('Acción completada', 'Libro eliminado con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Libro no eliminado');
      return redirect()->back()->withInput();
    }
  }

  public function referencias_bancos()
  {
    $referencias = Libro_ref::where('empresa_id', Auth::user()->empresa_id)->get();
    $bancos = Banco::where('empresa_id', Auth::user()->empresa_id)->get();
    return view('Administracion.referencias-bancos', compact('referencias', 'bancos'));
  }

  public function api_libros(Request $request)
  {
    $res = Libro::where('usuario_id', $request->usuario)->get();
    return response()->json($res, 200);
  }

  public function api_info(Request $request)
  {
    $movimientos = Libro_movimientos::where('usuario_id', $request->usuario)->where('libro_id', $request->libro)->whereBetween('fecha', [$request->fechaini, $request->fechafin])->get();

    return response()->json(LibroResource::collection($movimientos), 200);
  }
}
