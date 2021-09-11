<?php

namespace App\Http\Controllers\Sistema;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Sistema\Clave;

use App\Http\Requests\Sistema\StoreClave;
use App\Http\Requests\Sistema\UpdateClave;

class ClavesController extends Controller
{
  use SoftDeletes;

  public function show()
  {
    $claves = Clave::where('empresa_id', Auth::user()->empresa_id)->get();
    return view('Sistema.claves', compact('claves'));
  }

  public function store(StoreClave $request)
  {
    $validated = $request->validated();
    $validated['empresa_id'] = Auth::user()->empresa_id;
    $validated['clave'] = Crypt::encryptString($validated['clave']);
    if (isset($validated['refuerzo'])) {
      $validated['refuerzo'] = Crypt::encryptString($validated['refuerzo']);
    }

    DB::beginTransaction();
    try {
      if ($clave = Clave::create($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Clave creada con éxito');
        return redirect()->route('tablero');
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Clave no creada');
      return redirect()->back()->withInput();
    }
  }

  public function update(UpdateClave $request, Clave $clave)
  {
    $validated = $request->validated();
    $validated['clave'] = Crypt::encryptString($validated['clave']);
    if (isset($validated['refuerzo'])) {
      $validated['refuerzo'] = Crypt::encryptString($validated['refuerzo']);
    }

    DB::beginTransaction();
    try {
      if ($clave->update($validated)) {
        DB::commit();
        Alert::success('Acción completada', 'Clave modificada con éxito');
        return redirect()->route('tablero');
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Clave no modificada');
      return redirect()->back()->withInput();
    }
  }

  public function delete(Clave $clave)
  {
    DB::beginTransaction();
    try {
      if ($clave->delete()) {
        DB::commit();
        Alert::success('Acción completada', 'Clave eliminada con éxito');
        return redirect()->route('tablero');
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Clave no eliminada');
      return redirect()->back()->withInput();
    }
  }
}
