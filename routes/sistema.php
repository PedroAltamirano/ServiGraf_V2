<?php
Route::namespace('Sistema')
->middleware('hasModRol:80,1')
->group(function () {
  Route::get('horarios', 'HorariosController@show')->name('horarios')->middleware('hasModRol:80,1');
  Route::post('horario/store', 'HorariosController@store')->name('horario.store')->middleware('hasModRol:80,2');
  Route::put('horario/update/{horario}', 'HorariosController@update')->name('horario.update')->middleware('hasModRol:80,3');

  Route::get('/empresa', 'EmpresaController@show')->name('empresa')->middleware('hasModRol:81,1');
  Route::post('/empresa/store', 'EmpresaController@store')->name('empresa.store')->middleware('hasModRol:81,2');
  Route::put('/empresa/update/{empresa}', 'EmpresaController@update')->name('empresa.update')->middleware('hasModRol:81,3');

  Route::get('facturacion-empresas', 'FacturacionController@index')->name('facturacion-empresas')->middleware('hasModRol:81,1');
  Route::post('facturacion-empresas/store', 'FacturacionController@store')->name('facturacion-empresas.store')->middleware('hasModRol:81,2');
  Route::put('facturacion-empresas/update/{factura}', 'FacturacionController@update')->name('facturacion-empresas.update')->middleware('hasModRol:81,3');

  Route::post('/claves', 'ClavesController@show')->name('claves')->middleware('hasModRol:81,1')->middleware('password.confirm');
  Route::post('/clave/store', 'ClavesController@store')->name('clave.store')->middleware('hasModRol:81,2');
  Route::put('/clave/update/{clave}', 'ClavesController@update')->name('clave.update')->middleware('hasModRol:81,3');
  Route::delete('/clave/delete/{clave}', 'ClavesController@delete')->name('clave.delete')->middleware('hasModRol:81,4');

  Route::get('centro-costos', 'CentroCostosController@index')->name('centro-costos.get')->middleware('hasModRol:81,1');
  Route::post('centro-costos/store', 'CentroCostosController@store')->name('centro-costos.store')->middleware('hasModRol:81,2');
  Route::put('centro-costos/update/{centro}', 'CentroCostosController@update')->name('centro-costos.update')->middleware('hasModRol:81,3');
});
