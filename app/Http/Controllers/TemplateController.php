<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ventas\StoreTarea;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Ventas\CRM;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class TemplateController extends Controller
{
  use SoftDeletes;

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('Ventas.crm', compact());
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
  public function store(StoreTarea $request)
  {
    $user = Auth::user();
    $validated = $request->validated();
    $validated['empresa_id'] = $user->empresa_id;
    $validated['creador_id'] = $user->cedula;
    // $validated['modificador_id'] = $user->cedula;

    DB::beginTransaction();
    try {
      if ($tarea = CRM::create($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Evento creado con éxito');
        return redirect()->route('crm.edit', $tarea);
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::success('Acción completada', 'Evento creado con éxito');
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
