<?php
Route::namespace('Ventas')
  ->middleware('hasModRol:50,1')
  ->group(function () {
    // AJAX
    Route::post('contacto/info', 'ContactoController@info')->name('contacto.info');
    Route::post('cliente/info', 'ContactoController@infoCliente')->name('cliente.info');
    Route::post('contacto/crear', 'ContactoController@store')->name('contacto.store');

    // ACTIVIDADES
    Route::get('actividades', 'ActividadController@index')->name('actividad')->middleware('hasModRol:51,1');
    Route::get('actividad/crear', 'ActividadController@create')->name('actividad.create')->middleware('hasModRol:51,2');
    Route::post('actividad/crear', 'ActividadController@store')->name('actividad.store')->middleware('hasModRol:51,2');
    Route::get('actividad/modificar/{actividad}', 'ActividadController@edit')->name('actividad.edit')->middleware('hasModRol:51,3');
    Route::put('actividad/modificar/{actividad}', 'ActividadController@update')->name('actividad.update')->middleware('hasModRol:51,3');
    Route::delete('actividad/eliminar/{actividad}', 'ActividadController@destroy')->name('actividad.delete')->middleware('hasModRol:51,4');

    // PLANTILLAS
    Route::get('plantillas', 'PlantillaController@index')->name('plantilla')->middleware('hasModRol:51,1');
    Route::get('plantilla/crear', 'PlantillaController@create')->name('plantilla.create')->middleware('hasModRol:51,2');
    Route::post('plantilla/crear', 'PlantillaController@store')->name('plantilla.store')->middleware('hasModRol:51,2');
    Route::get('plantilla/modificar/{plantilla}', 'PlantillaController@edit')->name('plantilla.edit')->middleware('hasModRol:51,3');
    Route::put('plantilla/modificar/{plantilla}', 'PlantillaController@update')->name('plantilla.update')->middleware('hasModRol:51,3');
    Route::delete('plantilla/eliminar/{plantilla}', 'PlantillaController@destroy')->name('plantilla.delete')->middleware('hasModRol:51,4');

    // CRM
    Route::get('crm', 'CRMController@index')->name('crm')->middleware('hasModRol:50,1');
    Route::post('tarea/crear', 'CRMController@store')->name('crm.store')->middleware('hasModRol:50,2');
    Route::get('tarea/modificar/{tarea}', 'CRMController@edit')->name('crm.edit')->middleware('hasModRol:50,3');
    Route::put('tarea/modificar/{tarea}', 'CRMController@update')->name('crm.update')->middleware('hasModRol:50,3');
    Route::delete('tarea/eliminar/{tarea}', 'CRMController@delete')->name('crm.delete')->middleware('hasModRol:50,4');

    // CONTACTOS
    Route::get('contactos', 'ContactoController@index')->name('contacto')->middleware('hasModRol:50,1');
    Route::post('contacto/crear', 'ContactoController@store')->name('contacto.store')->middleware('hasModRol:50,2');
    Route::get('contacto/ver/{contacto}', 'ContactoController@show')->name('contacto.show')->middleware('hasModRol:50,3');
    Route::put('contacto/modificar/{contacto}', 'ContactoController@update')->name('contacto.update')->middleware('hasModRol:50,3');
    Route::delete('contacto/eliminar/{contacto}', 'ContactoController@destroy')->name('contacto.delete')->middleware('hasModRol:50,4');

    // COMENTARIOS
    Route::post('comentario/crear', 'ComentarioController@store')->name('comentario.store')->middleware('hasModRol:50,2');
    Route::put('comentario/modificar/{comentario}', 'ComentarioController@update')->name('comentario.update')->middleware('hasModRol:50,3');
    Route::delete('comentario/eliminar/{comentario}', 'ComentarioController@delete')->name('comentario.delete')->middleware('hasModRol:50,4');
  });
