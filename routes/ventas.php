<?php
Route::namespace('Ventas')
// ->middleware('hasModRol:80,1')
->group(function () {
  // Route::get('/ventas', '')->name('crm');
  Route::post('cliente/info', 'Clientes@info')->name('cliente.info');
  Route::post('cliente/store', 'Clientes@store')->name('cliente.store');
});
