<?php
Route::namespace('Ventas')
  ->middleware('hasModRol:50,1')
  ->group(function () {
    // Route::get('/ventas', '')->name('crm');
    Route::post('contacto/info', 'ContactoController@info')->name('contacto.info');
    Route::post('contacto/store', 'ContactoController@store')->name('contacto.store');

    // CRM
    Route::get('/crm', 'CRMController@index')->name('crm')->middleware('hasModRol:50,1');
    Route::post('tarea/store', 'CRMController@store')->name('crm.store')->middleware('hasModRol:50,2');
    Route::get('tarea/edit/{tarea}', 'CRMController@edit')->name('crm.edit')->middleware('hasModRol:50,3');
    Route::put('tarea/update/{tarea}', 'CRMController@update')->name('crm.update')->middleware('hasModRol:50,3');
    Route::delete('tarea/delete/{tarea}', 'CRMController@delete')->name('crm.delete')->middleware('hasModRol:50,4');
  });
