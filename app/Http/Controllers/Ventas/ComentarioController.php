<?php

namespace App\Http\Controllers\Ventas;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Ventas\Comentario;

use App\Http\Requests\Ventas\StoreComentario;
use App\Http\Requests\Ventas\UpdateComentario;
use App\Notifications\NewComment;

class ComentarioController extends Controller
{
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
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreComentario $request)
  {
    $user = Auth::user();
    $validated = $request->validated();
    $validated['empresa_id'] = $user->empresa_id;
    $validated['creador_id'] = $user->cedula;

    DB::beginTransaction();
    try {
      if ($comentario = Comentario::create($validated)) {
        $comentario->asignado->notify(new NewComment($comentario));
        DB::commit();
        Alert::success('Acción completada', 'Comentario creado con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Comentario no creado');
      return redirect()->back()->withInput();
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Ventas\Comentario  $comentario
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateComentario $request, Comentario $comentario)
  {
    $validated = $request->validated();
    // dd($comentario);

    DB::beginTransaction();
    try {
      if ($comentario->update($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Comentario modificado con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Comentario no modificado');
      return redirect()->back();
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Ventas\Comentario  $comentario
   * @return \Illuminate\Http\Response
   */
  public function destroy(Comentario $comentario)
  {
    DB::beginTransaction();
    try {
      if ($comentario->delete()) {
        DB::commit();
        Alert::success('Acción completada', 'Comentario eliminado con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Comentario no eliminado');
      return redirect()->back();
    }
  }
}
