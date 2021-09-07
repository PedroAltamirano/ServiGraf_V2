<?php
Route::namespace('Produccion')
  ->middleware('hasModRol:30,1')
  ->group(function () {
    // PEDIDOS
    Route::get('pedidos/get', 'PedidosController@get')->name('pedidos.get')->middleware('hasModRol:30,1');
    Route::get('pedidos', 'PedidosController@show')->name('pedidos')->middleware('hasModRol:30,1');
    Route::get('pedido/nuevo', 'PedidosController@create')->name('pedido.create')->middleware('hasModRol:30,2');
    Route::post('pedido/nuevo', 'PedidosController@store')->name('pedido.post')->middleware('hasModRol:30,2');
    Route::get('pedido/modificar/{pedido}', 'PedidosController@edit')->name('pedido.edit')->middleware('hasModRol:30,3');
    Route::put('pedido/modificar/{pedido}', 'PedidosController@update')->name('pedido.update')->middleware('hasModRol:30,3');
    Route::get('pedido/duplicar/{pedido}', 'PedidosController@duplicate')->name('pedido.duplicate')->middleware('hasModRol:30,3');
    Route::post('pedido/modal', 'PedidosController@modal')->name('pedido.modal')->middleware('hasModRol:30,1');
    Route::post('abonos/{pedido}', 'PedidosController@abonos')->name('abonos')->middleware('hasModRol:30,3');

    // REPORTE DE PEDIDOS
    Route::get('reporte/pedidos', 'ReportesController@showPedidos')->name('reporte.pedidos')->middleware('hasModRol:32,1');
    Route::get('reporte/ajaxpedidos', 'ReportesController@ajaxPedidos')->name('reporte.pedidos.ajax')->middleware('hasModRol:32,1');

    // REPORTE DE PAGOS
    Route::get('reporte/pagos', 'ReportesController@showPagos')->name('reporte.pagos')->middleware('hasModRol:33,1');
    Route::get('reporte/ajaxpagos', 'ReportesController@ajaxPagos')->name('reporte.pagos.ajax')->middleware('hasModRol:33,1');

    // REPORTE DE MAQUINAS
    Route::get('reporte/maquinas', 'ReportesController@showMaquinas')->name('reporte.maquinas')->middleware('hasModRol:34,1');
    Route::get('reporte/ajaxmaquinas', 'ReportesController@ajaxMaquinas')->name('reporte.maquinas.ajax')->middleware('hasModRol:34,1');

    // PROCESOS
    Route::get('procesos', 'ProcesosController@show')->name('procesos')->middleware('hasModRol:35,1');

    Route::get('proceso/nuevo', 'ProcesosController@create')->name('proceso.create')->middleware('hasModRol:35,2');
    Route::post('proceso/nuevo', 'ProcesosController@store')->name('proceso.store')->middleware('hasModRol:35,2');
    Route::get('proceso/modificar/{proceso}', 'ProcesosController@edit')->name('proceso.edit')->middleware('hasModRol:35,3');
    Route::put('proceso/modificar/{proceso}', 'ProcesosController@update')->name('proceso.update')->middleware('hasModRol:35,3');

    Route::post('area/nuevo', 'AreasController@store')->name('area.store')->middleware('hasModRol:35,2');
    Route::put('area/modificar/{area}', 'AreasController@update')->name('area.update')->middleware('hasModRol:35,3');

    // MATERIALES
    Route::get('materiales', 'MaterialesController@show')->name('materiales')->middleware('hasModRol:36,1');
    Route::get('material/nuevo', 'MaterialesController@create')->name('material.create')->middleware('hasModRol:36,2');
    Route::post('material/nuevo', 'MaterialesController@store')->name('material.store')->middleware('hasModRol:36,2');
    Route::get('material/modificar/{material}', 'MaterialesController@edit')->name('material.edit')->middleware('hasModRol:36,3');
    Route::put('material/modificar/{material}', 'MaterialesController@update')->name('material.update')->middleware('hasModRol:36,3');

    Route::post('categoria/nuevo', 'CategoriasController@store')->name('categoria.store')->middleware('hasModRol:36,2');
    Route::put('categoria/modificar/{categoria}', 'CategoriasController@update')->name('categoria.update')->middleware('hasModRol:36,3');

    Route::post('tinta/nuevo', 'TintasController@store')->name('tinta.store')->middleware('hasModRol:36,2');
    Route::put('tinta/modificar/{tinta}', 'TintasController@update')->name('tinta.update')->middleware('hasModRol:36,3');

    // PROVEEDORES
    Route::post('proveedor', 'ProveedoresController@store')->name('proveedor.store')->middleware('hasModRol:30,2');
  });
