<?php
Route::namespace('Ventas')
->middleware('hasModRol:50,1')
->group(function () {
  // Route::get('/ventas', '')->name('crm');
  Route::post('cliente/info', 'Clientes@info')->name('cliente.info');
  Route::post('cliente/store', 'Clientes@store')->name('cliente.store');

  Route::get('/crm', 'CRMController@index')->name('crm')->middleware('hasModRol:50,1');
});
