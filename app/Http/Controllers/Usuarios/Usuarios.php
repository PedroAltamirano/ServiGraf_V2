<?php

namespace App\Http\Controllers\Usuarios;

use App\Security;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

use App\Models\Usuarios\Usuario;
use App\Models\Usuarios\Perfil;
use App\Models\Sistema\Nomina;
use App\Http\Requests\Usuarios\Store;
use App\Http\Requests\Usuarios\Update;

class Usuarios extends Controller
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

	//ver todos los usuarios
	public function show(){
		if(Security::hasRol(70, 1)){
			return view('Usuarios/usuarios');
		} else {
			$data = [
				'type'=>'danger',
				'title'=>'NO AUTORIZADO',
				'message'=>'No estas autorizado a realizar esta operacion'
			];
			return redirect()->route('tablero')->with(['actionStatus' => json_encode($data)]);
		}
	}

	//crear usuario view
	public function create(){
		if(Security::hasRol(70, 1)){
			$nomina = Nomina::availables();
			$perfiles = Perfil::where('empresa_id', Auth::user()->empresa_id)->select('id', 'nombre')->get();
			$data = [
				'path'=>route('usuario.nuevo'),
				'text'=>'Nuevo usuario',
				'action'=>'Crear',
				// 'nomina'=>json_decode($nomina),
				// 'perfiles'=>json_decode($perfiles),
				'method'=>'POST'
			];

			$usuario = new Usuario;
			return view('Usuarios/usuario', compact('usuario', 'nomina', 'perfiles'))->with($data);
		} else {
			$data = [
				'type'=>'danger',
				'title'=>'NO AUTORIZADO',
				'message'=>'No estas autorizado a realizar esta operacion'
			];
			return redirect()->route('usuarios')->with(['actionStatus' => json_encode($data)]);
		}
	}

	 //crear nuevo
	 public function store(Store $request){
		if(Security::hasRol(70, 2)){
			$validator = $request->validated();
			$validator['empresa_id'] = Auth::user()->empresa_id;
			$validator['password'] = Hash::make($request->password);
			$usuario = Usuario::create($validator);

			$data = [
				'type'=>'success',
				'title'=>'Acción completada',
				'message'=>'El usuario se ha creado con éxito'
			];
			return redirect()->route('usuario.modificar', [$usuario->cedula])->with(['actionStatus' => json_encode($data)]);

		} else {
			$data = [
				'type'=>'danger',
				'title'=>'NO AUTORIZADO',
				'message'=>'No estás autorizado a realizar esta operación'
			];
			return redirect()->route('usuarios')->with(['actionStatus' => json_encode($data)]);
		}
	}

	//ver modificar usuario
	public function edit(Usuario $usuario){
		if(Security::hasRol(70, 3)){
			$nomina = Nomina::todos();
			$perfiles = Perfil::where('empresa_id', Auth::user()->empresa_id)->select('id', 'nombre')->get();
			$data = [
				'path'=> route('usuario.modificar', [$usuario->cedula]),
				'text'=>'Modificar usuario',
				'action'=>'Modificar',
				// 'nomina'=>json_decode($nomina),
				// 'perfiles'=>json_decode($perfiles),
				'method'=>'PUT'
			];

			return view('Usuarios/usuario', compact('usuario', 'nomina', 'perfiles'))->with($data);
			// return session('current.cedula');
		} else {
			$data = [
				'type'=>'danger',
				'title'=>'NO AUTORIZADO',
				'message'=>'No estás autorizado a realizar esta operación'
			];
			return redirect()->route('usuarios')->with(['actionStatus' => json_encode($data)]);
		}
	}

	//modificar perfil
	public function update(Update $request, Usuario $usuario){
		if(Security::hasRol(70, 3)){
			$validator = $request->validated();
			
			$validator['reservarot'] = $validator['reservarot'] ?? 0;
			$validator['libro'] = $validator['libro'] ?? 0;
			$usuario->update($validator);
			
			$data = [
				'type'=>'success',
				'title'=>'Acción completada',
				'message'=>'El usuario se ha modificado con éxito'
			];
			return redirect()->route('usuario.modificar', [$usuario->cedula])->with('actionStatus', json_encode($data));

		} else {
			$data = [
				'type'=>'danger',
				'title'=>'NO AUTORIZADO',
				'message'=>'No estas autorizado a realizar esta operación'
			];
			return redirect()->route('usuarios')->with(['actionStatus' => json_encode($data)]);
		}
	}


	//AJAX
	//get todos los perfiles
	public function get(){
		if(Security::hasRol(70, 1)){
			$data['data'] = Usuario::join('nomina as N', 'N.cedula', '=', 'usuarios.cedula')
											->where('N.empresa_id', 1709636664001)
											->select(['usuarios.cedula', 'usuarios.status', 'perfil'=>Perfil::select('nombre as perfil')->whereColumn('id', 'usuarios.perfil_id'), 'N.nombre', 'N.apellido'])
											->get();
			// echo json_encode($data);
			return response()->json($data);
		} else {
			return response('Unauthorized.', 401);
		}
	}

}
