<?php

Route::namespace('Usuarios')
->middleware('hasModRol:70,1')
->group(function () {
  Route::get('usuarios/get', 'UsuariosController@get')->name('usuarios.get')->middleware('hasModRol:70,1');
  Route::get('usuarios', 'UsuariosController@show')->name('usuarios')->middleware('hasModRol:70,1');
  Route::get('usuario/nuevo', 'UsuariosController@create')->name('usuario.nuevo')->middleware('hasModRol:70,2');
  Route::post('usuario/nuevo', 'UsuariosController@store')->name('usuario.nuevo')->middleware('hasModRol:70,2');
  Route::get('usuario/modificar/{usuario}', 'UsuariosController@edit')->name('usuario.modificar')->middleware('hasModRol:70,3');
  Route::put('usuario/modificar/{usuario}', 'UsuariosController@update')->name('usuario.modificar')->middleware('hasModRol:70,3');

  Route::get('perfiles/get', 'PerfilesController@get')->name('perfiles.get');
  Route::get('perfiles', 'PerfilesController@show')->name('perfiles')->middleware('hasModRol:71,1');
  Route::get('perfil/nuevo', 'PerfilesController@create')->name('perfil.nuevo')->middleware('hasModRol:71,2');
  Route::post('perfil/nuevo', 'PerfilesController@store')->name('perfil.nuevo')->middleware('hasModRol:71,2');
  Route::get('perfil/modificar/{perfil}', 'PerfilesController@edit')->name('perfil.modificar')->middleware('hasModRol:71,3');
  Route::put('perfil/modificar/{perfil}', 'PerfilesController@update')->name('perfil.modificar')->middleware('hasModRol:71,3');

});
