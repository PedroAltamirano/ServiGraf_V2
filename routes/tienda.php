<?php

Route::as('tienda.')
  ->namespace('Tienda')
  ->middleware('hasModRol:60,1')
  ->prefix('tienda')
  ->group(function () {
    Route::get('/', 'TiendaController@index')->name('index');
  });
