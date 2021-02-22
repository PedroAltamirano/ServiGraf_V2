<?php

Route::namespace('Administracion')
->middleware('hasModRol:20,1')
->group(function () {
  Route::get('facturacion', 'Facturacion@show')->name('facturacion')->middleware('hasModRol:21,1');
  Route::get('getFacturas', 'Facturacion@getFacts')->name('getFacturacion')->middleware('hasModRol:20,1');
  Route::get('factura/nueva', 'Facturacion@create')->name('factura.create')->middleware('hasModRol:21,2');
  Route::post('factura/nueva', 'Facturacion@store')->name('factura.store')->middleware('hasModRol:21,2');
  Route::get('factura/modificar/{factura}', 'Facturacion@edit')->name('factura.edit')->middleware('hasModRol:21,3');
  Route::put('factura/modificar/{factura}', 'Facturacion@update')->name('factura.update')->middleware('hasModRol:21,3');

  Route::get('libro', 'LibroController@index')->name('libro')->middleware('hasModRol:22,1');
  Route::post('libro/nuevo', 'LibroController@store')->name('libro.store')->middleware('hasModRol:22,1');
  Route::post('libro/api/libros', 'LibroController@api_libros')->name('libro.api.libros')->middleware('hasModRol:22,1');
  Route::post('libro/api/info', 'LibroController@api_info')->name('libro.api.info')->middleware('hasModRol:22,1');

  Route::get('entrada/nueva', 'EntradaController@create')->name('entrada.create')->middleware('hasModRol:22,2');
  Route::post('entrada/nueva', 'EntradaController@store')->name('entrada.store')->middleware('hasModRol:22,2');
  Route::get('entrada/modificar/{entrada}', 'EntradaController@edit')->name('entrada.edit')->middleware('hasModRol:22,3');
  Route::put('entrada/modificar/{entrada}', 'EntradaController@update')->name('entrada.update')->middleware('hasModRol:22,3');

  Route::get('referencias-bancos', 'LibroController@referencias_bancos')->name('referencias-bancos')->middleware('hasModRol:23,1');
  Route::post('referencia/nueva', 'ReferenciaController@store')->name('referencia.store')->middleware('hasModRol:23,2');
  Route::put('referencia/modificar/{libro_ref}', 'ReferenciaController@update')->name('referencia.update')->middleware('hasModRol:23,3');
  Route::post('banco/nueva', 'BancoController@store')->name('banco.store')->middleware('hasModRol:23,2');
  Route::put('banco/modificar/{banco}', 'BancoController@update')->name('banco.update')->middleware('hasModRol:23,3');

  Route::get('rrhh', 'RRHH@show')->name('rrhh')->middleware('hasModRol:24,1');
});
