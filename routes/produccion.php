<?php
Route::namespace('Produccion')
  ->middleware('hasModRol:30,1')
  ->group(function () {
    // PEDIDOS
    Route::get('pedidos/get', 'PedidosController@get')->name('pedidos.get')->middleware('hasModRol:30,1');
    Route::get('pedidos', 'PedidosController@show')->name('pedidos')->middleware('hasModRol:30,1');
    Route::get('pedido/crear', 'PedidosController@create')->name('pedido.create')->middleware('hasModRol:30,2');
    Route::post('pedido/crear', 'PedidosController@store')->name('pedido.post')->middleware('hasModRol:30,2');
    Route::get('pedido/modificar/{pedido}', 'PedidosController@edit')->name('pedido.edit')->middleware('hasModRol:30,3');
    Route::put('pedido/modificar/{pedido}', 'PedidosController@update')->name('pedido.update')->middleware('hasModRol:30,3');
    Route::get('pedido/duplicar/{pedido}', 'PedidosController@duplicate')->name('pedido.duplicate')->middleware('hasModRol:30,3');
    Route::get('pedido/modal/{pedido}', 'PedidosController@modal')->name('pedido.modal')->middleware('hasModRol:30,1');
    Route::get('pedido/buscar', 'PedidosController@buscar')->name('pedido.buscar')->middleware('hasModRol:30,1');
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
    Route::get('proceso/crear', 'ProcesosController@create')->name('proceso.create')->middleware('hasModRol:35,2');
    Route::post('proceso/crear', 'ProcesosController@store')->name('proceso.store')->middleware('hasModRol:35,2');
    Route::get('proceso/modificar/{proceso}', 'ProcesosController@edit')->name('proceso.edit')->middleware('hasModRol:35,3');
    Route::put('proceso/modificar/{proceso}', 'ProcesosController@update')->name('proceso.update')->middleware('hasModRol:35,3');
    Route::delete('proceso/eliminar/{proceso}', 'ProcesosController@delete')->name('proceso.delete')->middleware('hasModRol:35,4');

    // AREA
    Route::post('area/crear', 'AreasController@store')->name('area.store')->middleware('hasModRol:35,2');
    Route::put('area/modificar/{area}', 'AreasController@update')->name('area.update')->middleware('hasModRol:35,3');
    Route::delete('area/eliminar/{area}', 'AreasController@delete')->name('area.delete')->middleware('hasModRol:35,4');

    // MATERIALES
    Route::get('materiales', 'MaterialesController@show')->name('materiales')->middleware('hasModRol:36,1');
    Route::get('material/crear', 'MaterialesController@create')->name('material.create')->middleware('hasModRol:36,2');
    Route::post('material/crear', 'MaterialesController@store')->name('material.store')->middleware('hasModRol:36,2');
    Route::get('material/modificar/{material}', 'MaterialesController@edit')->name('material.edit')->middleware('hasModRol:36,3');
    Route::put('material/modificar/{material}', 'MaterialesController@update')->name('material.update')->middleware('hasModRol:36,3');
    Route::delete('material/eliminar/{material}', 'MaterialesController@delete')->name('material.delete')->middleware('hasModRol:36,4');

    // CATEGORIAS
    Route::post('categoria/crear', 'CategoriasController@store')->name('categoria.store')->middleware('hasModRol:36,2');
    Route::put('categoria/modificar/{categoria}', 'CategoriasController@update')->name('categoria.update')->middleware('hasModRol:36,3');
    Route::delete('categoria/eliminar/{categoria}', 'CategoriasController@delete')->name('categoria.delete')->middleware('hasModRol:36,4');

    // TINTAS
    Route::post('tinta/crear', 'TintasController@store')->name('tinta.store')->middleware('hasModRol:36,2');
    Route::put('tinta/modificar/{tinta}', 'TintasController@update')->name('tinta.update')->middleware('hasModRol:36,3');
    Route::delete('tinta/eliminar/{tinta}', 'TintasController@delete')->name('tinta.delete')->middleware('hasModRol:36,3');

    // PROVEEDORES
    Route::post('proveedor', 'ProveedoresController@store')->name('proveedor.store')->middleware('hasModRol:30,2');
  });
