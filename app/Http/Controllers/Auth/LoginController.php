<?php

namespace App\Http\Controllers\Auth;

use Log;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\Usuarios\Usuario;

class LoginController extends Controller
{

  use AuthenticatesUsers;

  protected $redirectTo = 'tablero';

  public function __construct()
  {
    $this->middleware('guest', ['only' => 'show'])->except('logout');
  }

  public function show()
  {
    return view('auth.login');
  }

  public function getInfo(Request $request)
  {
    // $ModPerfRol = ModPerfRol::where('perfil_id', Auth::user()->perfil_id)->get();
    // $request->session()->put('ModPerfRol', $ModPerfRol);

    $user = Usuario::find(Auth::id());
    $userInfo = [];
    $userInfo['nomina'] = $user->nomina->nombre;
    $userInfo['empresa'] = $user->empresa->nombre;
    $userInfo['empresa_tipo'] = $user->empresa->tipoEmpresa->nombre;
    $userInfo['cloud'] = $user->empresa->datos->cloud ?? '';
    $userInfo['mail'] = $user->empresa->datos->mail ?? '';
    $request->session()->put('userInfo', $userInfo);
  }

  public function login(Request $request)
  {
    $credentials = $request->validate([
      'usuario' => 'string|required|max:20',
      'password' => 'string|required|max:128',
      'cedula' => 'int|required|max:2499999999',
    ]);
    $credentials['status'] = 1;
    $rememberMe = $request->get('remember');

    if (Auth::viaRemember()) {
      Self::getInfo($request);
      return redirect()->route('desktop');
    }
    if (Auth::attempt($credentials, $rememberMe)) {
      Self::getInfo($request);
      if (Auth::user()->modulos->where('modulo_id', 10)->count() > 0) {
        return redirect()->route('desktop');
      } else {
        return redirect()->route('tablero');
      }
    } else {
      Alert::error('Oops!', 'Datos erroneos');
      return redirect()->back()->withInput();
    }
  }

  public function logout(Request $request)
  {
    Auth::logout();
    return redirect()->route('login');
  }
}
