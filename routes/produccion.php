<?php
Route::namespace('Produccion')
->middleware('hasModRol:30,1')
->group(function () {
  Route::get('pedidos/get', 'Pedidos@get')->name('pedidos.get')->middleware('hasModRol:30,1');
  Route::get('pedidos', 'Pedidos@show')->name('pedidos')->middleware('hasModRol:30,1');
  Route::get('pedido/nuevo', 'Pedidos@create')->name('pedido.create')->middleware('hasModRol:30,2');
  Route::post('pedido/nuevo', 'Pedidos@store')->name('pedido.post')->middleware('hasModRol:30,2');
  Route::get('pedido/modificar/{pedido}', 'Pedidos@edit')->name('pedido.edit')->middleware('hasModRol:30,3');
  Route::put('pedido/modificar/{pedido}', 'Pedidos@update')->name('pedido.update')->middleware('hasModRol:30,3');
  Route::post('abonos/{pedido}', 'Pedidos@abonos')->name('abonos')->middleware('hasModRol:30,3');

  Route::get('reporte/pedidos', 'Reportes@showPedidos')->name('reporte.pedidos')->middleware('hasModRol:32,1');
  Route::get('reporte/ajaxpedidos', 'Reportes@ajaxPedidos')->name('reporte.pedidos.ajax')->middleware('hasModRol:32,1');
  Route::get('reporte/pagos', 'Reportes@showPagos')->name('reporte.pagos')->middleware('hasModRol:33,1');
  Route::get('reporte/ajaxpagos', 'Reportes@ajaxPagos')->name('reporte.pagos.ajax')->middleware('hasModRol:33,1');
  Route::get('reporte/maquinas', 'Reportes@showMaquinas')->name('reporte.maquinas')->middleware('hasModRol:34,1');
  Route::get('reporte/ajaxmaquinas', 'Reportes@ajaxMaquinas')->name('reporte.maquinas.ajax')->middleware('hasModRol:34,1');

  Route::get('procesos', 'Procesos@show')->name('procesos')->middleware('hasModRol:30,1');
  Route::get('materiales', 'Materiales@show')->name('materiales')->middleware('hasModRol:30,1');

  Route::post('proveedor', 'Proveedores@store')->name('proveedor.post')->middleware('hasModRol:30,2');
});