<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\SendMailResponse;

class contactMail extends Controller{

  function send(Request $request){
    $this->validate($request, [
      'nombre' => 'required',
      'email' => 'required|email',
      'asunto' => 'required',
      'mensaje' => 'required'
    ]);
    $data = array(
      'nombre' => $request->nombre,
      'email' => $request->email,
      'asunto' => $request->asunto,
      'mensaje' => $request->mensaje
    );
    
    Mail::to('pedroaal@hotmail.com')->send(new SendMail($data));
    if(Mail::failures()){
      return back()->with('danger', 'Correo no enviado, error!');  
    }
    Mail::to('pedroaal@hotmail.com')->send(new SendMailResponse($data));
    if(Mail::failures()){
      return back()->with('danger', 'Correo no enviado, error!');  
    }
    return back()->with('success', 'Gracias por contactarnos! Revisa tu correo para mas información');
  }
}
