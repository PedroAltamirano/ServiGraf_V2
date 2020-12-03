<?php

Route::namespace('Usuarios')
->middleware('hasModRol:70,1')
->group(function () {
  Route::get('usuarios/get', 'Usuarios@get')->name('usuarios.get')->middleware('hasModRol:70,1');
  Route::get('usuarios', 'Usuarios@show')->name('usuarios')->middleware('hasModRol:70,1');
  Route::get('usuario/nuevo', 'Usuarios@create')->name('usuario.nuevo')->middleware('hasModRol:70,2');
  Route::post('usuario/nuevo', 'Usuarios@store')->name('usuario.nuevo')->middleware('hasModRol:70,2');
  Route::get('usuario/modificar/{usuario}', 'Usuarios@edit')->name('usuario.modificar')->middleware('hasModRol:70,3');
  Route::put('usuario/modificar/{usuario}', 'Usuarios@update')->name('usuario.modificar')->middleware('hasModRol:70,3');

  Route::get('perfiles/get', 'Perfiles@get')->name('perfiles.get');
  Route::get('perfiles', 'Perfiles@show')->name('perfiles')->middleware('hasModRol:71,1');
  Route::get('perfil/nuevo', 'Perfiles@create')->name('perfil.nuevo')->middleware('hasModRol:71,2');
  Route::post('perfil/nuevo', 'Perfiles@store')->name('perfil.nuevo')->middleware('hasModRol:71,2');
  Route::get('perfil/modificar/{perfil}', 'Perfiles@edit')->name('perfil.modificar')->middleware('hasModRol:71,3');
  Route::put('perfil/modificar/{perfil}', 'Perfiles@update')->name('perfil.modificar')->middleware('hasModRol:71,3');

});