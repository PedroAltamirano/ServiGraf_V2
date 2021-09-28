<?php

Route::namespace('Administracion')
  ->middleware('hasModRol:20,1')
  ->group(function () {
    // FACTURAS
    Route::get('facturacion', 'FacturacionController@show')->name('facturacion')->middleware('hasModRol:21,1');
    Route::get('getFacturas', 'FacturacionController@getFacts')->name('getFacturacion')->middleware('hasModRol:20,1');
    Route::get('factura/crear', 'FacturacionController@create')->name('factura.create')->middleware('hasModRol:21,2');
    Route::post('factura/crear', 'FacturacionController@store')->name('factura.store')->middleware('hasModRol:21,2');
    Route::get('factura/modificar/{factura}', 'FacturacionController@edit')->name('factura.edit')->middleware('hasModRol:21,3');
    Route::put('factura/modificar/{factura}', 'FacturacionController@update')->name('factura.update')->middleware('hasModRol:21,3');

    // LIBROS
    Route::get('libro', 'LibroController@index')->name('libro')->middleware('hasModRol:23,1');
    Route::post('libro/crear', 'LibroController@store')->name('libro.store')->middleware('hasModRol:23,1');
    Route::post('libro/api/libros', 'LibroController@api_libros')->name('libro.api.libros')->middleware('hasModRol:23,1');
    Route::post('libro/api/info', 'LibroController@api_info')->name('libro.api.info')->middleware('hasModRol:23,1');

    // ENTRADAS LIBRO_DIARIO
    Route::get('entrada/crear', 'EntradaController@create')->name('entrada.create')->middleware('hasModRol:23,2');
    Route::post('entrada/crear', 'EntradaController@store')->name('entrada.store')->middleware('hasModRol:23,2');
    Route::get('entrada/modificar/{entrada}', 'EntradaController@edit')->name('entrada.edit')->middleware('hasModRol:23,3');
    Route::put('entrada/modificar/{entrada}', 'EntradaController@update')->name('entrada.update')->middleware('hasModRol:23,3');
    Route::delete('entrada/eliminar/{entrada}', 'EntradaController@delete')->name('entrada.delete')->middleware('hasModRol:23,4');

    // REFERENCIAS Y BANCOS
    Route::get('referencias-bancos', 'LibroController@referencias_bancos')->name('referencias-bancos')->middleware('hasModRol:22,1');

    Route::post('referencia/crear', 'ReferenciaController@store')->name('referencia.store')->middleware('hasModRol:22,2');
    Route::put('referencia/modificar/{libro_ref}', 'ReferenciaController@update')->name('referencia.update')->middleware('hasModRol:22,3');
    Route::delete('referencia/eliminar/{libro_ref}', 'ReferenciaController@delete')->name('referencia.delete')->middleware('hasModRol:22,4');

    Route::post('banco/crear', 'BancoController@store')->name('banco.store')->middleware('hasModRol:22,2');
    Route::put('banco/modificar/{banco}', 'BancoController@update')->name('banco.update')->middleware('hasModRol:22,3');
    Route::delete('banco/eliminar/{banco}', 'BancoController@delete')->name('banco.delete')->middleware('hasModRol:22,4');

    // IVAS
    Route::post('iva/crear', 'IvaController@store')->name('iva.store')->middleware('hasModRol:22,2');
    Route::put('iva/modificar/{iva}', 'IvaController@update')->name('iva.update')->middleware('hasModRol:22,3');
    Route::delete('iva/eliminar/{iva}', 'IvaController@delete')->name('iva.delete')->middleware('hasModRol:22,4');

    // RETENCIONES
    Route::post('retencion/crear', 'RetencionController@store')->name('retencion.store')->middleware('hasModRol:22,2');
    Route::put('retencion/modificar/{retencion}', 'RetencionController@update')->name('retencion.update')->middleware('hasModRol:22,3');
    Route::delete('retencion/eliminar/{retencion}', 'RetencionController@delete')->name('retencion.delete')->middleware('hasModRol:22,4');

    // DOTACION
    Route::post('dotacion/crear', 'DotacionController@store')->name('dotacion.store')->middleware('hasModRol:24,2');
    Route::put('dotacion/modificar/{dotacion}', 'DotacionController@update')->name('dotacion.update')->middleware('hasModRol:24,3');
    Route::delete('dotacion/eliminar/{dotacion}', 'DotacionController@delete')->name('dotacion.delete')->middleware('hasModRol:24,4');

    // NOMINA
    Route::get('nominas', 'NominaController@index')->name('nomina')->middleware('hasModRol:24,1');
    Route::get('nomina/crear', 'NominaController@create')->name('nomina.create')->middleware('hasModRol:24,2');
    Route::post('nomina/crear', 'NominaController@store')->name('nomina.store')->middleware('hasModRol:24,2');
    Route::get('nomina/modificar/{nomina}', 'NominaController@edit')->name('nomina.edit')->middleware('hasModRol:24,3');
    Route::put('nomina/modificar/{nomina}', 'NominaController@update')->name('nomina.update')->middleware('hasModRol:24,3');
    Route::delete('nomina/eliminar/{nomina}', 'NominaController@delete')->name('nomina.delete')->middleware('hasModRol:24,3');

    Route::get('rrhh', 'RRHHController@index')->name('rrhh')->middleware('hasModRol:25,1');
    Route::post('rrhh/api', 'RRHHController@api')->name('rrhh.api')->middleware('hasModRol:25,1');
    Route::get('asistencia/marcar', 'RRHHController@marcar')->name('asistencia.marcar')->middleware('hasModRol:25,2');
    Route::get('asistencia/crear', 'RRHHController@store')->name('asistencia.store')->middleware('hasModRol:25,2');
    Route::put('asistencia/modificar/{asistencia}', 'RRHHController@update')->name('asistencia.update')->middleware('hasModRol:25,3');
    Route::delete('asistencia/eliminar/{asistencia}', 'RRHHController@destroy')->name('asistencia.delete')->middleware('hasModRol:25,4');
  });
