<?php

namespace App\Http\Controllers\Usuarios;

use App\Security;
use App\Models\Usuarios\Usuario;
use App\Models\Usuarios\Perfil;
use App\Models\Sistema\Nomina;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;


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
			return redirect('tablero')->with(['actionStatus' => json_encode($data)]);
		}
	}

	//crear usuario view
	public function newGet(){
		if(Security::hasRol(70, 1)){
			$nomina = Nomina::availables();
			$perfiles = Perfil::where('empresa_id', Auth::user()->empresa_id)->select('id', 'perfil')->get();
			$data = [
				'path'=>'/usuario/nuevo',
				'text'=>'Nuevo usuario',
				'action'=>'Crear',
				'nomina'=>json_decode($nomina),
				'perfiles'=>json_decode($perfiles)
			];
			return view('Usuarios/usuario')->with($data);
		} else {
			$data = [
				'type'=>'danger',
				'title'=>'NO AUTORIZADO',
				'message'=>'No estas autorizado a realizar esta operacion'
			];
			return redirect('usuarios')->with(['actionStatus' => json_encode($data)]);
		}
	}

	 //crear nuevo
	 public function newPost(Request $request){
		if(Security::hasRol(70, 2)){
			$messages = [
				'required' => 'El campo :attribute es requerido.',
				'max' => 'El campo :attribute debe ser menor a :max caracteres.',
				'confirmed' => 'Las contraseñas deben coincidir.',
			];
			$validator = Validator::make($request->all(), [
				'nomina' => 'required',
				'usuario' => 'required|max:20',
				'password' => 'required|confirmed',
				'password_confirmation' => 'required',
				'perfil_id' => 'required',
				'status' => 'required'
			], $messages);
			if ($validator->fails()) {
				return back()->withErrors($validator)->withInput();
			}

			$usuario = new Usuario;
			$usuario->cedula = $request->nomina;
			$usuario->empresa_id = Auth::user()->empresa_id;
			$usuario->usuario = $request->usuario;
			$usuario->password = Hash::make($request->password);
			$usuario->perfil_id = $request->perfil_id;
			$usuario->reservarot = $request->reservarot ? 1:0;
			$usuario->libro = $request->libro ? 1:0;
			$usuario->save();

			$data = [
				'type'=>'success',
				'title'=>'Acción completada',
				'message'=>'El usuario se ha creado con éxito'
			];
			return redirect('usuario/modificar/'.$usuario->cedula)->withInput()->with(['actionStatus' => json_encode($data)]);

		} else {
			$data = [
				'type'=>'danger',
				'title'=>'NO AUTORIZADO',
				'message'=>'No estás autorizado a realizar esta operación'
			];
			return redirect('usuarios')->with(['actionStatus' => json_encode($data)]);
		}
	}

	//ver modificar usuario
	public function modGet(Request $request, $user_id){
		if(Security::hasRol(70, 3)){
			$nomina = Nomina::todos();
			$perfiles = Perfil::where('empresa_id', Auth::user()->empresa_id)->select('id', 'perfil')->get();
			$data = [
				'path'=>'/usuario/modificar/'.$user_id,
				'text'=>'Modificar usuario',
				'action'=>'Modificar',
				'nomina'=>json_decode($nomina),
				'perfiles'=>json_decode($perfiles)
			];

			$old = Usuario::find($user_id);
			$request->session()->flash('current', $old);
			return view('Usuarios/usuario')->with($data)->withInput($old);
			// return session('current.cedula');
		} else {
			$data = [
				'type'=>'danger',
				'title'=>'NO AUTORIZADO',
				'message'=>'No estás autorizado a realizar esta operación'
			];
			return redirect('usuarios')->with(['actionStatus' => json_encode($data)]);
		}
	}

	//modificar perfil
	public function modPost(Request $request, $user_id){
		if(Security::hasRol(70, 3)){
			$messages = [
				'required' => 'El campo :attribute es requerido.',
				'max' => 'El campo :attribute debe ser menor a :max caracteres.',
				'confirmed' => 'Las contraseñas deben coincidir.',
			];
			$validator = Validator::make($request->all(), [
				'usuario' => 'required|max:20',
				'perfil_id' => 'required'
			], $messages);
			if ($validator->fails()) {
				return back()->withErrors($validator)->withInput();
			}

			$usuario = Usuario::find($user_id);
			$usuario->usuario = $request->usuario;
			$usuario->perfil_id = $request->perfil_id;
			$usuario->status = $request->status ? 1:0;
			$usuario->reservarot = $request->reservarot ? 1:0;
			$usuario->libro = $request->libro ? 1:0;
			$usuario->save();

			$data = [
				'type'=>'success',
				'title'=>'Acción completada',
				'message'=>'El usuario se ha modificado con éxito'
			];
			return redirect('usuario/modificar/'.$user_id)->with(['actionStatus' => json_encode($data)]);

		} else {
			$data = [
				'type'=>'danger',
				'title'=>'NO AUTORIZADO',
				'message'=>'No estas autorizado a realizar esta operación'
			];
			return redirect('usuarios')->with(['actionStatus' => json_encode($data)]);
		}
	}


	//AJAX
	//get todos los perfiles
	public function get(){
		if(Security::hasRol(70, 1)){
			$data['data'] = Usuario::join('nomina as N', 'N.cedula', '=', 'usuarios.cedula')
											->where('N.empresa_id', 1709636664001)
											->select(['usuarios.cedula', 'usuarios.status', 'perfil'=>Perfil::select('perfil')->whereColumn('id', 'usuarios.perfil_id'), 'N.nombre', 'N.apellido'])
											->get();
			// echo json_encode($data);
			return response()->json($data);
		} else {
			return response('Unauthorized.', 401);
		}
	}

}
