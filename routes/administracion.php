<?php

Route::namespace('Administracion')
->middleware('hasModRol:20,1')
->group(function () {
  Route::get('facturacion', 'Facturacion@show')->name('facturacion')->middleware('hasModRol:21,1');
  Route::get('getFacturas', 'Facturacion@getFacts')->name('getFacturacion')->middleware('hasModRol:20,1');
  Route::get('factura/nueva', 'Facturacion@create')->name('factura.create')->middleware('hasModRol:21,2');
  Route::post('factura/nueva', 'Facturacion@store')->name('factura.store')->middleware('hasModRol:21,2');
  Route::get('factura/modificar', 'Facturacion@edit')->name('factura.edit')->middleware('hasModRol:21,3');
  Route::put('factura/modificar/{factura}', 'Facturacion@update')->name('factura.update')->middleware('hasModRol:21,3');

  Route::get('libro', 'Libro@show')->name('libro')->middleware('hasModRol:22,1');

  Route::get('rrhh', 'RRHH@show')->name('rrhh')->middleware('hasModRol:24,1');
});
