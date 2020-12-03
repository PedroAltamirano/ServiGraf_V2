<?php

Route::namespace('Administracion')
->middleware('hasModRol:20,1')
->group(function () { 
  Route::get('/facturacion', 'Facturacion@show')->name('facturacion');
  Route::get('/getFacturas', 'Facturacion@getFacts')->name('getFacturacion');
  Route::get('/libro', 'Libro@show')->name('libro');
  Route::get('/rrhh', 'RRHH@show')->name('rrhh');
});