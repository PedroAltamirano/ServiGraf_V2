<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Usuarios\Usuario;
use App\Models\Administracion\Libro_movimientos;
use App\Models\Administracion\Libro;
use App\Models\Administracion\Libro_ref;
use App\Models\Administracion\Banco;

use App\Http\Resources\Administracion\LibroResource;
use App\Http\Requests\Administracion\StoreEntrada;
use App\Http\Requests\Administracion\UpdateEntrada;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    if($validated['tipo']){
      $validated['ingreso'] = $validated['valor'];
      $validated['egreso'] = 0;
    } else {
      $validated['egreso'] = $validated['valor'];
      $validated['ingreso'] = 0;
    }

    $entrada = Libro_movimientos::create($validated);

    $data = [
    'type'=>'success',
    'title'=>'Acción completada',
    'message'=>'La entrada se ha creado con éxito'
  ];
    return redirect()->route('entrada.edit', $entrada)->with(['actionStatus' => json_encode($data)]);
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
    if($validated['tipo']){
      $validated['ingreso'] = $validated['valor'];
      $validated['egreso'] = 0;
    } else {
      $validated['egreso'] = $validated['valor'];
      $validated['ingreso'] = 0;
    }

    $entrada->update($validated);

    $data = [
    'type'=>'success',
    'title'=>'Acción completada',
    'message'=>'La entrada se ha modificado con éxito'
  ];
    return redirect()->route('entrada.edit', $entrada)->with(['actionStatus' => json_encode($data)]);
  }
}
