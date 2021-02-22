<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Usuarios\Usuario;
use App\Models\Administracion\Libro_movimientos;
use App\Models\Administracion\Libro;

use App\Http\Resources\Administracion\LibroResource;
use App\Http\Requests\Administracion\StoreLibro;
use App\Http\Requests\Administracion\UpdateLibro;
use App\Models\Administracion\Banco;
use App\Models\Administracion\Libro_ref;

class LibroController extends Controller
{
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
      $libro = Libro::create($validated);

      $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'El libro se ha creado con éxito'
    ];
      return redirect()->back()->with(['actionStatus' => json_encode($data)]);
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
      $libro->update($validated);

      $data = [
      'type'=>'success',
      'title'=>'Acción completada',
      'message'=>'El libro se ha modificado con éxito'
    ];
      return redirect()->back()->with(['actionStatus' => json_encode($data)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  App\Models\Administracion\  $entrada
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function referencias_bancos()
    {
      $referencias = Libro_ref::where('empresa_id', Auth::user()->empresa_id)->get();
      $bancos = Banco::where('empresa_id', Auth::user()->empresa_id)->get();
      return view('Administracion.referencias-bancos', compact('referencias', 'bancos'));
    }

    public function api_libros(Request $request) {
      $res = Usuario::find($request->usuario)->libros;
      return response()->json($res, 200);
    }

    public function api_info(Request $request) {
      $movimientos = Libro_movimientos::where('usuario_id', $request->usuario)->where('libro_id', $request->libro)->whereBetween('fecha', [$request->fechaini, $request->fechafin])->get();

      return response()->json(LibroResource::collection($movimientos), 200);
    }
}
