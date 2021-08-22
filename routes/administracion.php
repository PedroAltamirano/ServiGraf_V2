<?php

Route::namespace('Administracion')
->middleware('hasModRol:20,1')
->group(function () {
  Route::get('facturacion', 'FacturacionController@show')->name('facturacion')->middleware('hasModRol:21,1');
  Route::get('getFacturas', 'FacturacionController@getFacts')->name('getFacturacion')->middleware('hasModRol:20,1');
  Route::get('factura/nueva', 'FacturacionController@create')->name('factura.create')->middleware('hasModRol:21,2');
  Route::post('factura/nueva', 'FacturacionController@store')->name('factura.store')->middleware('hasModRol:21,2');
  Route::get('factura/modificar/{factura}', 'FacturacionController@edit')->name('factura.edit')->middleware('hasModRol:21,3');
  Route::put('factura/modificar/{factura}', 'FacturacionController@update')->name('factura.update')->middleware('hasModRol:21,3');

  Route::get('libro', 'LibroController@index')->name('libro')->middleware('hasModRol:23,1');
  Route::post('libro/nuevo', 'LibroController@store')->name('libro.store')->middleware('hasModRol:23,1');
  Route::post('libro/api/libros', 'LibroController@api_libros')->name('libro.api.libros')->middleware('hasModRol:23,1');
  Route::post('libro/api/info', 'LibroController@api_info')->name('libro.api.info')->middleware('hasModRol:23,1');

  Route::get('entrada/nueva', 'EntradaController@create')->name('entrada.create')->middleware('hasModRol:23,2');
  Route::post('entrada/nueva', 'EntradaController@store')->name('entrada.store')->middleware('hasModRol:23,2');
  Route::get('entrada/modificar/{entrada}', 'EntradaController@edit')->name('entrada.edit')->middleware('hasModRol:23,3');
  Route::put('entrada/modificar/{entrada}', 'EntradaController@update')->name('entrada.update')->middleware('hasModRol:23,3');

  Route::get('referencias-bancos', 'LibroController@referencias_bancos')->name('referencias-bancos')->middleware('hasModRol:22,1');
  Route::post('referencia/nueva', 'ReferenciaController@store')->name('referencia.store')->middleware('hasModRol:22,2');
  Route::put('referencia/modificar/{libro_ref}', 'ReferenciaController@update')->name('referencia.update')->middleware('hasModRol:22,3');
  Route::post('banco/nueva', 'BancoController@store')->name('banco.store')->middleware('hasModRol:22,2');
  Route::put('banco/modificar/{banco}', 'BancoController@update')->name('banco.update')->middleware('hasModRol:22,3');

  Route::post('iva/nuevo', 'IvaController@store')->name('iva.store')->middleware('hasModRol:22,2');
  Route::put('iva/modificar/{iva}', 'IvaController@update')->name('iva.update')->middleware('hasModRol:22,3');

  Route::post('retencion/nuevo', 'RetencionController@store')->name('retencion.store')->middleware('hasModRol:22,2');
  Route::put('retencion/modificar/{retencion}', 'RetencionController@update')->name('retencion.update')->middleware('hasModRol:22,3');

  Route::get('rrhh', 'RRHHController@index')->name('rrhh')->middleware('hasModRol:24,1');
  Route::post('rrhh/api', 'RRHHController@api')->name('rrhh.api')->middleware('hasModRol:24,1');
  Route::put('asistencia/modificar/{asistencia}', 'RRHHController@update')->name('asistencia.update')->middleware('hasModRol:24,3');
  Route::delete('asistencia/eliminar/{asistencia}', 'RRHHController@destroy')->name('asistencia.delete')->middleware('hasModRol:24,4');

  Route::get('nominas', 'NominaController@index')->name('nomina')->middleware('hasModRol:24,1');
  Route::get('nomina/nueva', 'NominaController@create')->name('nomina.create')->middleware('hasModRol:24,2');
  Route::post('nomina/store', 'NominaController@store')->name('nomina.store')->middleware('hasModRol:24,2');
  Route::get('nomina/modificar', 'NominaController@edit')->name('nomina.edit')->middleware('hasModRol:24,3');
  Route::put('nomina/update', 'NominaController@update')->name('nomina.update')->middleware('hasModRol:24,3');
});
