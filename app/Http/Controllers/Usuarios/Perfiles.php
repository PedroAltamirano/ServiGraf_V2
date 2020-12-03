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
use Illuminate\Database\Eloquent\Collection;

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
		return view('Usuarios/perfiles');
	}

	//vista nuevo perfil
	public function create(){
		$modules = Modulo::todos();
		$perfil = new Perfil;
		$modPerf = new Collection([]);
		$data = [
			'path'=>route('perfil.nuevo'), 
			'text'=>'Nuevo perfil', 
			'action'=>'Crear',
			'method'=>'POST',
			// 'modules'=>json_decode($modules)
		];
		return view('Usuarios/perfil', compact('modules', 'perfil', 'modPerf'))->with($data);
	}

	//crear nuevo perfil
	public function store(StorePerfil $request){
		$validator = $request->validated();
		$validator['empresa_id'] = Auth::user()->empresa_id;
		
		$perfil = Perfil::create($validator);
		
		ModPerfRol::where('perfil_id', $perfil->id)->delete();
		foreach($validator['mod'] as $key => $value){
			$modPerfRol = new ModPerfRol;
			$modPerfRol->perfil_id = $perfil->id;
			$modPerfRol->modulo_id = $key;
			$modPerfRol->rol_id = count($value);
			$modPerfRol->save();
		}

		$data = [
			'type'=>'success', 
			'title'=>'Accion completada', 
			'message'=>'El perfil se ha creado con exito'
		];
		return redirect()->route('perfil.modificar', $perfil->id)->withInput()->with(['actionStatus' => json_encode($data)]);
	}

	//ver modificar perfil
	public function edit(Perfil $perfil){
		$modules = Modulo::todos();
		$data = [
			'path'=>route('perfil.modificar', $perfil->id), 
			'text'=>'Modificar perfil', 
			'action'=>'Modificar',
			'method'=>'PUT',
		];
		
		$modPerf = $perfil->modulos;
		
		return view('Usuarios/perfil', compact('modules', 'perfil', 'modPerf'))->with($data);
	}

	//modificar perfil
	public function update(UpdatePerfil $request, Perfil $perfil){
		$validator = $request->validated();
		// dd($validator);

		$validator['status'] = $validator['status'] ?? 0;
		$perfil->update($validator);


		ModPerfRol::where('perfil_id', $perfil->id)->delete();
		foreach($validator['mod'] as $key => $value){
			$modPerfRol = new ModPerfRol;
			$modPerfRol->perfil_id = $perfil->id;
			$modPerfRol->modulo_id = $key;
			$modPerfRol->rol_id = count($value);
			$modPerfRol->save();
		}

		$data = [
			'type'=>'success', 
			'title'=>'Accion completada', 
			'message'=>'El perfil se ha modificado con exito'
		];
		return redirect()->route('perfil.modificar', $perfil->id)->with(['actionStatus' => json_encode($data)]);
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