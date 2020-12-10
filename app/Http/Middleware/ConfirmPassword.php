<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ConfirmPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Hash::check($request->password, Auth::user()->password)){
            return $next($request);
        } else {
            $data = [
				'type'=>'danger', 
				'title'=>'NO AUTORIZADO', 
				'message'=>'Actualmente no tienes acceso a este modulo.'
			];
            return redirect()->route('tablero')->with(['actionStatus' => json_encode($data)]);
        }
    }
}
