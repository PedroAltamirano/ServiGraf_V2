<?php
namespace App;

class Security{
  static function hasModule($module){
    return in_array($module, array_column(json_decode(session('ModPerfRol')), 'modulo_id'))?1:0;
  }

  static function hasRol($module, $rol){
    if(Self::hasModule($module)){
      $posMod = array_search($module, array_column(json_decode(session('ModPerfRol')), 'modulo_id'));
      $rolId = array_column(json_decode(session('ModPerfRol')), 'rol_id');
      if($rol <= $rolId[$posMod]){
        return 1;
      } else {
        return 0;
      }
    } else {
      return 0;
    }
    
  }
}