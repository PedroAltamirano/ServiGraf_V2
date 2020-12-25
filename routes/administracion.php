<?php

Route::namespace('Administracion')
->middleware('hasModRol:20,1')
->group(function () {
  Route::get('facturacion', 'Facturacion@show')->name('facturacion')->middleware('hasModRol:21,1');
  Route::get('getFacturas', 'Facturacion@getFacts')->name('getFacturacion')->middleware('hasModRol:20,1');
  Route::get('factura/nueva', 'Facturacion@create')->name('factura.create')->middleware('hasModRol:21,2');

  Route::get('libro', 'Libro@show')->name('libro')->middleware('hasModRol:22,1');

  Route::get('rrhh', 'RRHH@show')->name('rrhh')->middleware('hasModRol:24,1');
});
