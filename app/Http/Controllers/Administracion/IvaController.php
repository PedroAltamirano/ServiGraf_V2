<?php

namespace App\Http\Controllers\Administracion;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Administracion\Iva;

use App\Http\Requests\Administracion\StoreIva;

class IvaController extends Controller
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
  public function store(StoreIva $request)
  {
    $validated = $request->validated();
    $validated['empresa_id'] = Auth::user()->empresa_id;
    $validated['status'] = $validated['status'] ?? 0;

    DB::beginTransaction();
    try {
      if ($iva = Iva::create($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Iva creado con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Iva no creado');
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
  public function update(StoreIva $request, Iva $iva)
  {
    $validated = $request->validated();
    $validated['status'] = $validated['status'] ?? 0;

    DB::beginTransaction();
    try {
      if ($iva->update($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Iva modificado con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Iva no modificado');
      return redirect()->back()->withInput();
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Iva $iva)
  {
    DB::beginTransaction();
    try {
      if ($iva->delete()) {
        DB::commit();
        Alert::success('Acción completada', 'Iva eliminado con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Iva no eliminado');
      return redirect()->back();
    }
  }
}
