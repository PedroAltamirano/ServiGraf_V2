<?php
namespace App\Http\Controllers\Produccion;

use App\Security;
use App\Models\Produccion\Pedido;
use App\Models\Ventas\Cliente;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;

class Pedidos extends Controller
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
  * Show pedidos dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function show(){
    if(Security::hasRol(30, 1)){
      $data = new Pedido();
      return view('Produccion/pedidos', compact('data'));
    } else {
      $data = [
        'type'=>'danger',
        'title'=>'NO AUTORIZADO',
        'message'=>'No estás autorizado a realizar esta operación'
      ];
      return redirect('tablero')->with(['actionStatus' => json_encode($data)]);
    }
  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function newGet(){
    if(Security::hasRol(30, 2)){
      $clientes = Cliente::todos();
      $data = [
      'path' => '/pedido/nuevo',
      'text' => 'Nuevo Pedido',
      'action' => 'Crear',
      'clientes' => $clientes,
      ];
      return view('Produccion.pedido')->with($data);
    } else {
      $data = [
        'type'=>'danger',
        'title'=>'NO AUTORIZADO',
        'message'=>'No estás autorizado a realizar esta operación'
      ];
      return redirect('pedidos')->with(['actionStatus' => json_encode($data)]);
    }
  }

  // crear nuevo 
// public function newPost(Request $request){
//   if(Security::hasRol(mod, 2)){
//     $messages = [
//       'required' => 'El campo :attribute es requerido.',
//       'max' => 'El campo :attribute debe ser menor a :max caracteres.'
//     ];
//     $validator = Validator::make($request->all(), [
    
//     ], $messages);
//     if ($validator->fails()) {
//       return back()->withErrors($validator)->withInput();
//     }

//     $model = new Model;
//     $model->save();

//     $data = [
//       'type'=>'success',
//       'title'=>'Acción completada',
//       'message'=>'El/La  se ha creado con éxito'
//     ];
//     return redirect('//'.$model->id)->withInput()->with(['actionStatus' => json_encode($data)]);
  
//   } else {
//     $data = [
//       'type'=>'danger',
//       'title'=>'NO AUTORIZADO',
//       'message'=>'No estás autorizado a realizar esta operación'
//     ];
//     return redirect('')->with(['actionStatus' => json_encode($data)]);
//   }
// }
 
 //ver modificar 
//  public function modGet(Request $request, $data_id){
//    if(Security::hasRol(mod, 3)){
//      $data = [
//        'path'=>'//modificar/'.$data_id,
//        'text'=>'Modificar ',
//        'action'=>'Modificar',
//      ];
//      $model = Model::find();
//      $old = [];
//      $old[''] = $model->;
//      $request->session()->flash('current', $old);
//      return view('')->with($data)->withInput($old);
//      // return session('current.perfil');
//    } else {
//      $data = [
//        'type'=>'danger',
//        'title'=>'NO AUTORIZADO',
//        'message'=>'No estás autorizado a realizar esta operación'
//      ];
//      return redirect('')->with(['actionStatus' => json_encode($data)]);
//    }
//  }
 
 //modificar perfil
//  public function modPost(Request $request, $data_id){
//    if(Security::hasRol(mod, 3)){
//      $messages = [
//        'required' => 'El campo :attribute es requerido.',
//        'max' => 'El campo :attribute debe ser menor a :max caracteres.'
//      ];
//      $validator = Validator::make($request->all(), [
//        '' => 'required|max:50',
//      ], $messages);
//      if ($validator->fails()) {
//        return back()->withErrors($validator)->withInput();
//      }
 
//      $model = Model::find($data_id);
//      $model->save();
 
//      $data = [
//        'type'=>'success',
//        'title'=>'Acción completada',
//        'message'=>'El/La se ha modificado con éxito'
//      ];
//      return redirect('/modificar//'.$data_id)->with(['actionStatus' => json_encode($data)]);
    
//    } else {
//      $data = [
//        'type'=>'danger',
//        'title'=>'NO AUTORIZADO',
//        'message'=>'No estas autorizado a realizar esta operación'
//      ];
//      return redirect('')->with(['actionStatus' => json_encode($data)]);
//    }
//  }


  //AJAX
  //get todos los perfiles
  public function get(){
    if(Security::hasRol(30, 1)){
      $data['data'] = Pedido::todos();
      return response()->json($data);
    } else {
      return response('Unauthorized.', 401);
    }
  }

}
