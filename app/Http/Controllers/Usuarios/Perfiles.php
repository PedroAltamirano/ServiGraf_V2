<?php

namespace App\Http\Controllers\Usuarios;

use App\Security;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;

use App\Models\Usuarios\Perfil;
use App\Models\Usuarios\Modulo;
use App\Models\Usuarios\ModPerfRol;
use App\Http\Requests\Usuarios\StorePerfil;
use App\Http\Requests\Usuarios\UpdatePerfil;

class Perfiles extends Controller
{
	use AuthenticatesUsers;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */


	//vista todos los perfiles
	public function show(){
		if(Security::hasRol(71, 1)){
			return view('Usuarios/perfiles');
		} else {
			$data = [
				'type'=>'danger', 
				'title'=>'NO AUTORIZADO', 
				'message'=>'No estas autorizado a realizar esta operacion'
			];
			return redirect('tablero')->with(['actionStatus' => json_encode($data)]);
		}
	}

	//vista nuevo perfil
	public function create(){
		if(Security::hasRol(71, 2)){
			$modules = Modulo::todos();
			$perfil = new Perfil;
			$modPerf = '';
			$data = [
				'path'=>route('perfil.nuevo'), 
				'text'=>'Nuevo perfil', 
				'action'=>'Crear',
				'method'=>'POST',
				// 'modules'=>json_decode($modules)
			];
			return view('Usuarios/perfil', compact('modules', 'perfil', 'modPerf'))->with($data);
		} else {
			$data = [
				'type'=>'danger', 
				'title'=>'NO AUTORIZADO', 
				'message'=>'No estas autorizado a realizar esta operacion'
			];
			return redirect()->route('perfiles')->with(['actionStatus' => json_encode($data)]);
		}
	}

	//crear nuevo perfil
	public function store(StorePerfil $request){
		if(Security::hasRol(71, 2)){
			$validator = $request->validated();

			$perfil = new Perfil;
			$perfil->empresa_id = Auth::user()->empresa_id;
			$perfil->perfil = $request->perfil;
			$perfil->descripcion = $request->descripcion;
			$perfil->save();

			ModPerfRol::where('perfil_id', $perfil->id)->delete();
			$filtered = $request->except(['_token', 'perfil', 'descripcion', 'status']);
			$data = [];
			foreach($filtered as $key=>$val){
				$modRol = explode('-', $key);
				$data[$modRol[0]] = $modRol[1];
			}
			foreach($data as $mod=>$rol){
				$modPerfRol = new ModPerfRol;
				$modPerfRol->perfil_id = $perfil->id;
				$modPerfRol->modulo_id = $mod;
				$modPerfRol->rol_id = $rol;
				$modPerfRol->save();
			}

			$data = [
				'type'=>'success', 
				'title'=>'Accion completada', 
				'message'=>'El perfil se ha creado con exito'
			];
			return redirect('perfil/modificar/'.$perfil->id)->withInput()->with(['actionStatus' => json_encode($data)]);
			
		} else {
			$data = [
				'type'=>'danger', 
				'title'=>'NO AUTORIZADO', 
				'message'=>'No estas autorizado a realizar esta operacion'
			];
			return redirect('perfiles')->with(['actionStatus' => json_encode($data)]);
		}
	}

	//ver modificar perfil
	public function edit(Perfil $perfil){
		if(Security::hasRol(71, 3)){
			$modules = Modulo::todos();
			$data = [
				'path'=>route('perfil.modificar', $perfil->id), 
				'text'=>'Modificar perfil', 
				'action'=>'Modificar',
				'method'=>'PUT',
			];
			
			$modPerf = $perfil->modulos;
			$modPerf = $modPerf->map(function($modPerf){ return $modPerf->modulo_id.'-'.$modPerf->rol_id; });
			
			return view('Usuarios/perfil', compact('modules', 'perfil', 'modPerf'))->with($data);
		} else {
			$data = [
				'type'=>'danger', 
				'title'=>'NO AUTORIZADO', 
				'message'=>'No estas autorizado a realizar esta operacion'
			];
			return redirect('perfiles')->with(['actionStatus' => json_encode($data)]);
		}
	}

	//modificar perfil
	public function update(Request $request, $perfil_id){
		if(Security::hasRol(71, 3)){
			$messages = [
				'required' => 'El campo :attribute es requerido.',
				'max' => 'El campo :attribute debe ser menor a :max caracteres.'
			];
			$validator = Validator::make($request->all(), [
        'perfil' => 'required|max:50',
        'descripcion' => 'required|max:140'
			], $messages);
			if ($validator->fails()) {
				return back()->withErrors($validator)->withInput();
      }

			$perfil = Perfil::find($perfil_id);
			$perfil->perfil = $request->perfil;
			$perfil->descripcion = $request->descripcion;
			$perfil->status = $request->status?1:0;
			$perfil->save();


			ModPerfRol::where('perfil_id', $perfil_id)->delete();
			$filtered = $request->except(['_token', 'perfil', 'descripcion', 'status']);
			$data = [];
			foreach($filtered as $key=>$val){
				$modRol = explode('-', $key);
				$data[$modRol[0]] = $modRol[1];
			}
			foreach($data as $mod=>$rol){
				$modPerfRol = new ModPerfRol;
				$modPerfRol->perfil_id = $perfil_id;
				$modPerfRol->modulo_id = $mod;
				$modPerfRol->rol_id = $rol;
				$modPerfRol->save();
			}

			$data = [
				'type'=>'success', 
				'title'=>'Accion completada', 
				'message'=>'El perfil se ha modificado con exito'
			];
			return redirect('perfil/modificar/'.$perfil_id)->with(['actionStatus' => json_encode($data)]);
			
		} else {
			$data = [
				'type'=>'danger', 
				'title'=>'NO AUTORIZADO', 
				'message'=>'No estas autorizado a realizar esta operacion'
			];
			return redirect('perfiles')->with(['actionStatus' => json_encode($data)]);
		}
	}


	//AJAX
	//get todos los perfiles
	public function get(){
		if(Security::hasRol(71, 1)){
			$data = Perfil::todos();
			return response()->json(array('data' => $data));
		} else {
			return response('Unauthorized.', 401);
		}
	}

}