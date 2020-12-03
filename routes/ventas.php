<?php

// Route::get('/ventas', '')->name('crm');
Route::post('/ventas/telefono', 'Ventas\Clientes@telefono')->name('cliente.telefono');
Route::post('/ventas/cliente', 'Ventas\Clientes@store')->name('contacto.cliente.post');