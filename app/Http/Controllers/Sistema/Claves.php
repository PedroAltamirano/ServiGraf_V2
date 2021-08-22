<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

use App\Models\Sistema\Clave;
use App\Http\Requests\Sistema\StoreClave;
use App\Http\Requests\Sistema\UpdateClave;
use Illuminate\Database\Eloquent\SoftDeletes;

class Claves extends Controller
{
  use SoftDeletes;
  
    public function show(){
        $claves = Clave::where('empresa_id', Auth::user()->empresa_id)->get();
        return view('Sistema.claves', compact('claves'));
    }

    public function store(StoreClave $request){
        $validated = $request->validated();
        $validated['empresa_id'] = Auth::user()->empresa_id;
        $validated['clave'] = Crypt::encryptString($validated['clave']);
        if(isset($validated['refuerzo'])){
            $validated['refuerzo'] = Crypt::encryptString($validated['refuerzo']);
        }
        $clave = Clave::create($validated);

        $data = [
            'type'=>'success',
            'title'=>'Acción completada',
            'message'=>'La clave se ha creado con éxito'
        ];
        return redirect()->route('tablero')->with(['actionStatus' => json_encode($data)]);
    }

    public function update(UpdateClave $request, Clave $clave){
        $validated = $request->validated();
        $validated['clave'] = Crypt::encryptString($validated['clave']);
        if(isset($validated['refuerzo'])){
            $validated['refuerzo'] = Crypt::encryptString($validated['refuerzo']);
        }
        $clave->update($validated);

        $data = [
            'type'=>'success',
            'title'=>'Acción completada',
            'message'=>'La clave se ha modificado con éxito'
        ];
        return redirect()->route('tablero')->with(['actionStatus' => json_encode($data)]);
    }

    public function delete(Clave $clave){
        $clave->delete();

        $data = [
            'type'=>'success',
            'title'=>'Acción completada',
            'message'=>'La clave se ha eliminado con éxito'
        ];
        return redirect()->route('tablero')->with(['actionStatus' => json_encode($data)]);
    }
}
