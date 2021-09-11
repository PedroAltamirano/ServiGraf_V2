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
use App\Models\Administracion\Libro_ref;
use App\Models\Administracion\Banco;

use App\Http\Resources\Administracion\LibroResource;
use App\Http\Requests\Administracion\StoreEntrada;
use App\Http\Requests\Administracion\UpdateEntrada;

class EntradaController extends Controller
{
  use SoftDeletes;

  public function create()
  {
    $entrada = new Libro_movimientos();
    $usuarios = Usuario::where('empresa_id', Auth::user()->empresa_id)->where('libro', 1)->get();
    $referencias = Libro_ref::where('empresa_id', Auth::user()->empresa_id)->get();
    $bancos = Banco::where('empresa_id', Auth::user()->empresa_id)->get();
    $data = [
      'text' => 'Nueva Entrada',
      'path' => route('entrada.store'),
      'method' => 'POST',
      'action' => 'Crear',
    ];
    return view('Administracion.entrada', compact('entrada', 'usuarios', 'referencias', 'bancos'))->with($data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  App\Http\Requests\Administracion\StoreEntrada  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreEntrada $request)
  {
    $validated = $request->validated();
    if ($validated['tipo']) {
      $validated['ingreso'] = $validated['valor'];
      $validated['egreso'] = 0;
    } else {
      $validated['egreso'] = $validated['valor'];
      $validated['ingreso'] = 0;
    }

    DB::beginTransaction();
    try {
      if ($entrada = Libro_movimientos::create($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Entrada creada con éxito');
        return redirect()->route('entrada.edit', $entrada);
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Entrada no creada');
      return redirect()->back()->withInput();
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  App\Models\Administracion\Libro_movimientos  $entrada
   * @return \Illuminate\Http\Response
   */
  public function edit(Libro_movimientos $entrada)
  {
    $usuarios = Usuario::where('empresa_id', Auth::user()->empresa_id)->where('libro', 1)->get();
    $referencias = Libro_ref::where('empresa_id', Auth::user()->empresa_id)->get();
    $bancos = Banco::where('empresa_id', Auth::user()->empresa_id)->get();
    $data = [
      'text' => 'Modificar Entrada',
      'path' => route('entrada.update', $entrada),
      'method' => 'PUT',
      'action' => 'Modificar',
    ];
    return view('Administracion.entrada', compact('entrada', 'usuarios', 'referencias', 'bancos'))->with($data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  App\Http\Requests\Administracion\UpdateEntrada  $request
   * @param  App\Models\Administracion\Libro_movimientos  $entrada
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateEntrada $request, Libro_movimientos $entrada)
  {
    $validated = $request->validated();
    if ($validated['tipo']) {
      $validated['ingreso'] = $validated['valor'];
      $validated['egreso'] = 0;
    } else {
      $validated['egreso'] = $validated['valor'];
      $validated['ingreso'] = 0;
    }

    DB::beginTransaction();
    try {
      if ($entrada->update($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Entrada modificada con éxito');
        return redirect()->route('entrada.edit', $entrada);
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Entrada no modificada');
      return redirect()->back()->withInput();
    }
  }
}
