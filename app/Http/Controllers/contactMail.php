<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\SendMailResponse;

class contactMail extends Controller{

  function send(Request $request){
    $data = $this->validate($request, [
      'nombre' => 'required',
      'email' => 'required|email',
      'asunto' => 'required',
      'mensaje' => 'required'
    ]);
    
    /**
     * Mensaje que alguien ha escrito por paguina web
     */
    Mail::to('info@servigraf.com')->send(new SendMail($data));
    if(Mail::failures()){
      return back()->with('danger', 'Correo no enviado, error!');  
    }

    /**
     * Respuesta automatica
     */
    Mail::to('pedroaal@hotmail.com')->send(new SendMailResponse($data));
    if(Mail::failures()){
      return back()->with('danger', 'Correo no enviado, error!');  
    }
    
    return back()->with('success', 'Gracias por contactarnos! Revisa tu correo para mas información');
  }
}
