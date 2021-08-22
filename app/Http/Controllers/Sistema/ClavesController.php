<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    $clave = Clave::create($validated);

    $data = [
      'type' => 'success',
      'title' => 'Acción completada',
      'message' => 'La clave se ha creado con éxito'
    ];
    Alert::success('Acción completada', 'La área se ha modificado con éxito');
    return redirect()->route('tablero')->with(['actionStatus' => json_encode($data)]);
  }

  public function update(UpdateClave $request, Clave $clave)
  {
    $validated = $request->validated();
    $validated['clave'] = Crypt::encryptString($validated['clave']);
    if (isset($validated['refuerzo'])) {
      $validated['refuerzo'] = Crypt::encryptString($validated['refuerzo']);
    }
    $clave->update($validated);

    $data = [
      'type' => 'success',
      'title' => 'Acción completada',
      'message' => 'La clave se ha modificado con éxito'
    ];
    Alert::success('Acción completada', 'La área se ha modificado con éxito');
    return redirect()->route('tablero')->with(['actionStatus' => json_encode($data)]);
  }

  public function delete(Clave $clave)
  {
    $clave->delete();

    $data = [
      'type' => 'success',
      'title' => 'Acción completada',
      'message' => 'La clave se ha eliminado con éxito'
    ];
    Alert::success('Acción completada', 'La área se ha modificado con éxito');
    return redirect()->route('tablero')->with(['actionStatus' => json_encode($data)]);
  }
}
