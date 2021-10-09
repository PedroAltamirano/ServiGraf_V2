<?php

namespace App\Http\Controllers\Sistema;

use Exception;
use App\Helpers\Archivos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Sistema\FactEmpr;
use App\Models\Administracion\Iva;
use App\Models\Administracion\Retencion;

use App\Http\Requests\Sistema\StoreFactura;
use App\Http\Requests\Sistema\UpdateFactura;

class FacturacionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $user = Auth::user();
    $facturas = FactEmpr::where('empresa_id', $user->empresa_id)->get();
    $ivas = Iva::where('empresa_id', $user->empresa_id)->get();
    $ret_iva = Retencion::where('empresa_id', $user->empresa_id)->where('tipo', 1)->get();
    $ret_fnt = Retencion::where('empresa_id', $user->empresa_id)->where('tipo', 0)->get();
    return view('Sistema.facturacion', compact('facturas', 'ivas', 'ret_iva', 'ret_fnt'));
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
  public function store(StoreFactura $request)
  {
    $validated = $request->validated();
    $validated['empresa_id'] = Auth::user()->empresa_id;
    $validated['valido_a'] = $validated['valido_de'];
    $file = $validated['logo'];
    $validated['logo'] = '';

    DB::beginTransaction();
    try {
      if ($factura = FactEmpr::create($validated)) {
        if (isset($file)) {
          $name = $factura->id;
          $imageName = Archivos::storeImagen($name, $file, 'facturas');
          $factura->logo = $imageName;
          $factura->save();
        }

        DB::commit();
        Alert::success('Acción completada', 'Datos de facturación creados con éxito');
        return redirect()->route('facturacion-empresas');
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Datos de facturación no creados');
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
  public function update(UpdateFactura $request, FactEmpr $factura)
  {
    $validated = $request->validated();
    $validated['status'] = $validated['status'] ?? 0;
    $validated['valido_a'] = $validated['valido_de'];

    DB::beginTransaction();
    try {
      if ($factura->update($validated)) {
        if (isset($validated['logo'])) {
          $name = $factura->id;
          $imageName = Archivos::storeImagen($name, $validated['logo'], 'facturas');
          $factura->logo = $imageName;
          $factura->save();
        }

        DB::commit();
        Alert::success('Acción completada', 'Datos de facturación modificados con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Datos de facturación no modificados');
      return redirect()->back()->withInput();
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(FactEmpr $factura)
  {
    DB::beginTransaction();
    try {
      if ($factura->delete()) {
        DB::commit();
        Alert::success('Acción completada', 'Datos de facturación eliminados con éxito');
        return redirect()->back();
      }
    } catch (Exception $error) {
      DB::rollBack();
      Log::error($error);
      Alert::error('Oops!', 'Datos de facturación no eliminados');
      return redirect()->back();
    }
  }
}
