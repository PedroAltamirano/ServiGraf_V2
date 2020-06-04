<?php

namespace App\Http\Controllers\Usuarios;

use App\Security;
use App\Models\Usuarios\Perfil;
use App\Models\Usuarios\Modulo;
use App\Models\Usuarios\ModPerfRol;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;

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
	public function newGet(){
		if(Security::hasRol(71, 2)){
			$modules = Modulo::todos();
			$data = [
				'path'=>'/perfil/nuevo', 
				'text'=>'Nuevo perfil', 
				'action'=>'Crear',
				'modules'=>json_decode($modules)
			];
			return view('Usuarios/perfil')->with($data);
		} else {
			$data = [
				'type'=>'danger', 
				'title'=>'NO AUTORIZADO', 
				'message'=>'No estas autorizado a realizar esta operacion'
			];
			return redirect('perfiles')->with(['actionStatus' => json_encode($data)]);
		}
	}

	//crear nuevo perfil
	public function newPost(Request $request){
		if(Security::hasRol(71, 2)){
			$messages = [
				'required' => 'El campo :attribute es requerido.',
				'max' => 'El campo :attribute debe ser menor a :max caracteres.',
				'unique' => 'Este nombre de perfil ya existe.'
			];
			$validator = Validator::make($request->all(), [
        'perfil' => 'required|max:50|unique:perfiles,perfil,empresa_id',
        'descripcion' => 'required|max:140',
        'status' => 'required',
			], $messages);
			if ($validator->fails()) {
				return back()->withErrors($validator)->withInput();
      }

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
	public function modGet(Request $request, $perfil_id){
		if(Security::hasRol(71, 3)){
			$modules = Modulo::todos();
			$data = [
				'path'=>'/perfil/modificar/'.$perfil_id, 
				'text'=>'Modificar perfil', 
				'action'=>'Modificar',
				'modules'=>json_decode($modules)
			];
			$perfil = Perfil::select(['perfil', 'descripcion', 'status'])->where('id', $perfil_id)->get();
			$modPerf = ModPerfRol::where('perfil_id', $perfil_id)->get();
			$old = [];
			$perfiles = $perfil->first();
			$old['perfil'] = $perfiles->perfil;
			$old['descripcion'] = $perfiles->descripcion;
			$old['status'] = $perfiles->status?'on':'';
			foreach($modPerf as $e){
				for($i=1; $i<=$e->rol_id; $i++){
					$index = $e->modulo_id.'-'.$i;
					$old[$index] = 'on';
				}
			}
			$request->session()->flash('current', $old);
			return view('Usuarios/perfil')->with($data)->withInput($old);
			// return session('current.perfil');
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
	public function modPost(Request $request, $perfil_id){
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