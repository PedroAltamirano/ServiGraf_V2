<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Helpers\Archivos;
use App\Models\Sistema\DatosEmpresa;
use App\Models\Sistema\Fact_empr;
use App\Http\Requests\Sistema\StoreEmpresa;
use App\Http\Requests\Sistema\UpdateEmpresa;
use App\Http\Requests\Sistema\StoreFactura;
use App\Http\Requests\Sistema\UpdateFactura;

class Empresa extends Controller
{
    public function show(){
        $empresa = Auth::user()->empresa->datos ?? new DatosEmpresa;
        $facturas = Fact_empr::where('empresa_id', Auth::user()->empresa_id)->get();
        return view('Sistema.empresa', compact('empresa', 'facturas'));
    }

    public function store(StoreEmpresa $request){
        $validated = $request->validated();
        $validated['empresa_id'] = Auth::user()->empresa_id;
        $validated['usuario_id_mod'] = Auth::id();
        $empresa = DatosEmpresa::create($validated);
        $data = [
            'type'=>'success',
            'title'=>'Acción completada',
            'message'=>'Los datos se ha creado con éxito'
        ];
        return redirect()->route('empresa')->with(['actionStatus' => json_encode($data)]);
    }

    public function update(UpdateEmpresa $request, DatosEmpresa $empresa){
        $validated = $request->validated();
        $empresa->update($validated);
        $data = [
            'type'=>'success',
            'title'=>'Acción completada',
            'message'=>'Los datos se ha modificado con éxito'
        ];
        return redirect()->back()->with(['actionStatus' => json_encode($data)]);
    }

    public function storeFact(StoreFactura $request){
        $validated = $request->validated();
        $validated['empresa_id'] = Auth::user()->empresa_id;
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
        return redirect()->route('empresa')->with(['actionStatus' => json_encode($data)]);
    }

    public function updateFact(UpdateFactura $request, Fact_empr $factura){
        $validated = $request->validated();
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
}
