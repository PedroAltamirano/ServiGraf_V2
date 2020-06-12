<?php
namespace App;
use App\Models\Usuarios\ModPerfRol;
use Auth;

class Security{
  static function hasModule($module){
    // return in_array($module, array_column(json_decode(session('ModPerfRol')), 'modulo_id'))?1:0;
    return ModPerfRol::where('perfil_id', Auth::user()->perfil_id)->where('modulo_id', intval($module))->exists();
  }

  static function hasRol($module, $rol){
    for($i = 4; $i >= $rol; $i--){
      $flag = ModPerfRol::where('perfil_id', Auth::user()->perfil_id)->where('modulo_id', intval($module))->where('rol_id', intval($i))->exists();
      if($flag) return $flag;
    }
    return false;
   
      // if(Self::hasModule($module)){
    //   $posMod = array_search($module, array_column(json_decode(session('ModPerfRol')), 'modulo_id'));
    //   $rolId = array_column(json_decode(session('ModPerfRol')), 'rol_id');
    //   if($rol <= $rolId[$posMod]){
    //     return 1;
    //   } else {
    //     return 0;
    //   }
    // } else {
    //   return 0;
    // }
    
  }
}