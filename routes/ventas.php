<?php
Route::namespace('Ventas')
  ->middleware('hasModRol:50,1')
  ->group(function () {
    // Route::get('/ventas', '')->name('crm');
    Route::post('contacto/info', 'ContactoController@info')->name('contacto.info');
    Route::post('cliente/info', 'ContactoController@infoCliente')->name('cliente.info');
    Route::post('contacto/store', 'ContactoController@store')->name('contacto.store');

    // Actividades
    Route::get('actividades', 'ActividadController@index')->name('actividad')->middleware('hasModRol:51,1');
    Route::get('actividad/create', 'ActividadController@create')->name('actividad.create')->middleware('hasModRol:51,2');
    Route::post('actividad/store', 'ActividadController@store')->name('actividad.store')->middleware('hasModRol:51,2');
    Route::get('actividad/edit/{actividad}', 'ActividadController@edit')->name('actividad.edit')->middleware('hasModRol:51,3');
    Route::put('actividad/update/{actividad}', 'ActividadController@update')->name('actividad.update')->middleware('hasModRol:51,3');
    Route::delete('actividad/delete/{actividad}', 'ActividadController@destroy')->name('actividad.delete')->middleware('hasModRol:51,4');

    // Plantillas
    Route::get('plantillas', 'PlantillaController@index')->name('plantilla')->middleware('hasModRol:51,1');
    Route::get('plantilla/create', 'PlantillaController@create')->name('plantilla.create')->middleware('hasModRol:51,2');
    Route::post('plantilla/store', 'PlantillaController@store')->name('plantilla.store')->middleware('hasModRol:51,2');
    Route::get('plantilla/edit/{plantilla}', 'PlantillaController@edit')->name('plantilla.edit')->middleware('hasModRol:51,3');
    Route::put('plantilla/update/{plantilla}', 'PlantillaController@update')->name('plantilla.update')->middleware('hasModRol:51,3');
    Route::delete('plantilla/delete/{plantilla}', 'PlantillaController@destroy')->name('plantilla.delete')->middleware('hasModRol:51,4');

    // CRM
    Route::get('/crm', 'CRMController@index')->name('crm')->middleware('hasModRol:50,1');
    Route::post('tarea/store', 'CRMController@store')->name('crm.store')->middleware('hasModRol:50,2');
    Route::get('tarea/edit/{tarea}', 'CRMController@edit')->name('crm.edit')->middleware('hasModRol:50,3');
    Route::put('tarea/update/{tarea}', 'CRMController@update')->name('crm.update')->middleware('hasModRol:50,3');
    Route::delete('tarea/delete/{tarea}', 'CRMController@delete')->name('crm.delete')->middleware('hasModRol:50,4');

    // Contactos
    Route::get('contactos', 'ContactoController@index')->name('contacto')->middleware('hasModRol:50,1');
    Route::post('contacto/store', 'ContactoController@store')->name('contacto.store')->middleware('hasModRol:50,2');
    Route::get('contacto/show/{contacto}', 'ContactoController@edit')->name('contacto.show')->middleware('hasModRol:50,3');
    Route::put('contacto/update/{contacto}', 'ContactoController@update')->name('contacto.update')->middleware('hasModRol:50,3');
    Route::delete('contacto/delete/{contacto}', 'ContactoController@delete')->name('contacto.delete')->middleware('hasModRol:50,4');
  });
