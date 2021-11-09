<?php

Route::namespace('Tienda')
  ->middleware('hasModRol:60,1')
  ->group(function () {
    Route::get('productos', 'ProductoController@index')->name('productos');
  });
