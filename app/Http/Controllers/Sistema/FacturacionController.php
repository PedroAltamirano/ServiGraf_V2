<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Helpers\Archivos;
use App\Models\Sistema\Fact_empr;
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
      $facturas = Fact_empr::where('empresa_id', Auth::user()->empresa_id)->get();
      $ivas = Iva::where('empresa_id', Auth::user()->empresa_id)->get();
      $ret_iva = Retencion::where('empresa_id', Auth::user()->empresa_id)->where('tipo', 1)->get();
      $ret_fnt = Retencion::where('empresa_id', Auth::user()->empresa_id)->where('tipo', 0)->get();
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
      $factura = Fact_empr::create($validated);

      if(isset($file)){
        $name = $factura->id;
        $imageName = Archivos::storeImagen($name, $file, 'facturas');
        $factura->logo = $imageName;
        $factura->save();
      }

      $data = [
        'type'=>'success',
        'title'=>'Acción completada',
        'message'=>'Los datos se ha creado con éxito'
      ];
      return redirect()->route('facturacion-empresas')->with(['actionStatus' => json_encode($data)]);
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
    public function update(UpdateFactura $request, Fact_empr $factura)
    {
      $validated = $request->validated();
      $validated['status'] = $validated['status'] ?? 0;
      $validated['valido_a'] = $validated['valido_de'];
      $factura->update($validated);
      if(isset($validated['logo'])){
          $name = $factura->id;
          $imageName = Archivos::storeImagen($name, $validated['logo'], 'facturas');
          $factura->logo = $imageName;
          $factura->save();
      }

      $data = [
          'type'=>'success',
          'title'=>'Acción completada',
          'message'=>'Los datos se ha modificado con éxito'
      ];
      return redirect()->back()->with(['actionStatus' => json_encode($data)]);
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
