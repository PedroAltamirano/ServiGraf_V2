<?php
Route::namespace('Sistema')
  ->middleware('hasModRol:80,1')
  ->group(function () {
    // HORARIOS
    Route::get('horarios', 'HorariosController@show')->name('horarios')->middleware('hasModRol:80,1');
    Route::post('horario/crear', 'HorariosController@store')->name('horario.store')->middleware('hasModRol:80,2');
    Route::put('horario/modificar/{horario}', 'HorariosController@update')->name('horario.update')->middleware('hasModRol:80,3');
    Route::delete('horario/eliminar/{horario}', 'HorariosController@delete')->name('horario.delete')->middleware('hasModRol:80,4');

    // DATOS DE LA EMPRESA
    Route::get('empresa', 'EmpresaController@show')->name('empresa')->middleware('hasModRol:81,1');
    Route::post('empresa/crear', 'EmpresaController@store')->name('empresa.store')->middleware('hasModRol:81,2');
    Route::put('empresa/modificar/{empresa}', 'EmpresaController@update')->name('empresa.update')->middleware('hasModRol:81,3');
    Route::delete('empresa/eliminar/{empresa}', 'EmpresaController@delete')->name('empresa.delete')->middleware('hasModRol:81,4');

    // EMPRESAS DE FACTURACION
    Route::get('facturacion-empresas', 'FacturacionController@index')->name('facturacion-empresas')->middleware('hasModRol:81,1');
    Route::post('facturacion-empresas/crear', 'FacturacionController@store')->name('facturacion-empresas.store')->middleware('hasModRol:81,2');
    Route::put('facturacion-empresas/modificar/{factura}', 'FacturacionController@update')->name('facturacion-empresas.update')->middleware('hasModRol:81,3');
    Route::delete('facturacion-empresas/eliminar/{factura}', 'FacturacionController@delete')->name('facturacion-empresas.delete')->middleware('hasModRol:81,4');

    // CLAVES
    Route::post('claves', 'ClavesController@show')->name('claves')->middleware('hasModRol:81,1')->middleware('password.confirm');
    Route::post('clave/crear', 'ClavesController@store')->name('clave.store')->middleware('hasModRol:81,2');
    Route::put('clave/modificar/{clave}', 'ClavesController@update')->name('clave.update')->middleware('hasModRol:81,3');
    Route::delete('clave/eliminar/{clave}', 'ClavesController@delete')->name('clave.delete')->middleware('hasModRol:81,4');

    // CENTRO DE COSTOS
    Route::get('centro-costos', 'CentroCostosController@index')->name('centro-costos.get')->middleware('hasModRol:81,1');
    Route::post('centro-costos/crear', 'CentroCostosController@store')->name('centro-costos.store')->middleware('hasModRol:81,2');
    Route::put('centro-costos/modificar/{centro}', 'CentroCostosController@update')->name('centro-costos.update')->middleware('hasModRol:81,3');
    Route::delete('centro-costos/eliminar/{centro}', 'CentroCostosController@delete')->name('centro-costos.delete')->middleware('hasModRol:81,4');

    // EMPRESAS
    Route::get('empresas', 'EmpresasController@index')->name('empresas');
    Route::post('empresas/crear', 'EmpresasController@store')->name('empresas.store');
    Route::put('empresas/modificar/{empresa}', 'EmpresasController@update')->name('empresas.update');
    Route::delete('empresas/eliminar/{empresa}', 'EmpresasController@destroy')->name('empresas.delete');
  });
