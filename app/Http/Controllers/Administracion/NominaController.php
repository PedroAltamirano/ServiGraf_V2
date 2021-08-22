<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Sistema\Nomina;
use App\Models\Sistema\CentroCostos;
use App\Models\Sistema\Horario;

class NominaController extends Controller
{
  use SoftDeletes;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $nominas = Nomina::where('empresa_id', Auth::user()->empresa_id)->get();
      return view('Administracion.nominas', compact('nominas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $nomina = new Nomina();
      $ccostos = CentroCostos::where('empresa_id', Auth::user()->empresa_id)->get();
      $horarios = Horario::where('empresa_id', Auth::user()->empresa_id)->get();
      $data = [
        'text' => 'Nueva Nomina',
        'path' => route('nomina.create'),
        'method' => 'POST',
        'action' => 'Crear',
      ];
      return view('Administracion.nomina', compact('nomina', 'ccostos', 'horarios'))->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Alert::success('Acción completada', 'La área se ha modificado con éxito');
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
