<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */

	//ver todos los usuarios
	public function show(){
			return view('Usuarios/usuarios');
	}

	//crear usuario view
	public function create(){
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
	}

	 //crear nuevo
	 public function store(Store $request){
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
	}

	//ver modificar usuario
	public function edit(Usuario $usuario){
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
	}

	//modificar perfil
	public function update(Update $request, Usuario $usuario){
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
	}


	//AJAX
	//get todos los perfiles
	public function get(){
		$data['data'] = Usuario::join('nomina as N', 'N.cedula', '=', 'usuarios.cedula')
										->where('N.empresa_id', 1709636664001)
										->select(['usuarios.cedula', 'usuarios.status', 'perfil'=>Perfil::select('nombre as perfil')->whereColumn('id', 'usuarios.perfil_id'), 'N.nombre', 'N.apellido'])
										->get();
		// echo json_encode($data);
		return response()->json($data);
	}

}
