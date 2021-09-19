<?php

Route::namespace('Usuarios')
  ->middleware('hasModRol:70,1')
  ->group(function () {
    Route::get('usuarios/get', 'UsuariosController@get')->name('usuarios.get')->middleware('hasModRol:70,1');
    Route::get('usuarios', 'UsuariosController@show')->name('usuarios')->middleware('hasModRol:70,1');
    Route::get('usuario/crear', 'UsuariosController@create')->name('usuario.create')->middleware('hasModRol:70,2');
    Route::post('usuario/crear', 'UsuariosController@store')->name('usuario.store')->middleware('hasModRol:70,2');
    Route::get('usuario/modificar/{usuario}', 'UsuariosController@edit')->name('usuario.edit')->middleware('hasModRol:70,3');
    Route::put('usuario/modificar/{usuario}', 'UsuariosController@update')->name('usuario.update')->middleware('hasModRol:70,3');
    Route::delete('usuario/eliminar/{usuario}', 'UsuariosController@delete')->name('usuario.delete')->middleware('hasModRol:70,4');

    Route::get('perfiles/get', 'PerfilesController@get')->name('perfiles.get');
    Route::get('perfiles', 'PerfilesController@show')->name('perfiles')->middleware('hasModRol:71,1');
    Route::get('perfil/crear', 'PerfilesController@create')->name('perfil.create')->middleware('hasModRol:71,2');
    Route::post('perfil/crear', 'PerfilesController@store')->name('perfil.store')->middleware('hasModRol:71,2');
    Route::get('perfil/modificar/{perfil}', 'PerfilesController@edit')->name('perfil.edit')->middleware('hasModRol:71,3');
    Route::put('perfil/modificar/{perfil}', 'PerfilesController@update')->name('perfil.update')->middleware('hasModRol:71,3');
    Route::delete('perfil/eliminar/{perfil}', 'PerfilesController@delete')->name('perfil.delete')->middleware('hasModRol:71,4');
  });
