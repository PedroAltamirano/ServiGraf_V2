<?php

namespace App\Http\Controllers\Produccion;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Produccion\Proveedor;

use App\Http\Requests\Produccion\StoreProveedor;

class ProveedoresController extends Controller
{
  use SoftDeletes;

  public function store(StoreProveedor $request)
  {
    $validator = $request->validated();
    $validator['empresa_id'] = Auth::user()->empresa_id;
    $validator['usuario_id'] = Auth::id();

    DB::beginTransaction();
    try {
      if ($proveedor = Proveedor::create($validator)) {
        DB::commit();
        Alert::success('Acción completada', 'Proveedor creado con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Proveedor no creado');
      return redirect()->back()->withInput();
    }
  }
}
