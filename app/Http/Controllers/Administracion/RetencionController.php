<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Administracion\Retencion;

use App\Http\Requests\Administracion\StoreRetencion;

class RetencionController extends Controller
{
  use SoftDeletes;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRetencion $request)
    {
      $validated = $request->validated();
      $validated['empresa_id'] = Auth::user()->empresa_id;
      $validated['status'] = $validated['status'] ?? 0;

      Retencion::create($validated);

      $data = [
        'type'=>'success',
        'title'=>'Acción completada',
        'message'=>'La retención se ha creado con éxito'
      ];
      Alert::success('Acción completada', 'La área se ha modificado con éxito');
      return redirect()->back()->with($data);
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
    public function update(StoreRetencion $request, Retencion $retencion)
    {
      $validated = $request->validated();
      $validated['empresa_id'] = Auth::user()->empresa_id;
      $validated['status'] = $validated['status'] ?? 0;

      $retencion->update($validated);

      $data = [
        'type'=>'success',
        'title'=>'Acción completada',
        'message'=>'La retención se ha modificado con éxito'
      ];
      Alert::success('Acción completada', 'La área se ha modificado con éxito');
      return redirect()->back()->with($data);
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
