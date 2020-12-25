<?php
Route::namespace('Ventas')
// ->middleware('hasModRol:80,1')
->group(function () {
  // Route::get('/ventas', '')->name('crm');
  Route::post('cliente/telefono', 'Clientes@telefono')->name('cliente.telefono');
  Route::post('cliente/store', 'Clientes@store')->name('cliente.store');
});
