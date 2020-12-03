<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Usuarios\ModPerfRol;
use Illuminate\Support\Facades\Auth;

class hasModRol
{
    
    static function getModule($module){
        return ModPerfRol::where('perfil_id', Auth::user()->perfil_id)->where('modulo_id', intval($module))->first();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $module, $role)
    {
        $mod = $this->getModule($module);
        
        if(isset($mod) && $mod->rol_id >= $role){
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
