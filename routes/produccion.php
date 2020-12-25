<?php
Route::namespace('Produccion')
->middleware('hasModRol:30,1')
->group(function () {
  // PEDIDOS
  Route::get('pedidos/get', 'Pedidos@get')->name('pedidos.get')->middleware('hasModRol:30,1');
  Route::get('pedidos', 'Pedidos@show')->name('pedidos')->middleware('hasModRol:30,1');
  Route::get('pedido/nuevo', 'Pedidos@create')->name('pedido.create')->middleware('hasModRol:30,2');
  Route::post('pedido/nuevo', 'Pedidos@store')->name('pedido.post')->middleware('hasModRol:30,2');
  Route::get('pedido/modificar/{pedido}', 'Pedidos@edit')->name('pedido.edit')->middleware('hasModRol:30,3');
  Route::put('pedido/modificar/{pedido}', 'Pedidos@update')->name('pedido.update')->middleware('hasModRol:30,3');
  Route::post('abonos/{pedido}', 'Pedidos@abonos')->name('abonos')->middleware('hasModRol:30,3');

  // REPORTE DE PEDIDOS
  Route::get('reporte/pedidos', 'Reportes@showPedidos')->name('reporte.pedidos')->middleware('hasModRol:32,1');
  Route::get('reporte/ajaxpedidos', 'Reportes@ajaxPedidos')->name('reporte.pedidos.ajax')->middleware('hasModRol:32,1');

  // REPORTE DE PAGOS
  Route::get('reporte/pagos', 'Reportes@showPagos')->name('reporte.pagos')->middleware('hasModRol:33,1');
  Route::get('reporte/ajaxpagos', 'Reportes@ajaxPagos')->name('reporte.pagos.ajax')->middleware('hasModRol:33,1');

  // REPORTE DE MAQUINAS
  Route::get('reporte/maquinas', 'Reportes@showMaquinas')->name('reporte.maquinas')->middleware('hasModRol:34,1');
  Route::get('reporte/ajaxmaquinas', 'Reportes@ajaxMaquinas')->name('reporte.maquinas.ajax')->middleware('hasModRol:34,1');

  // PROCESOS
  Route::get('procesos', 'Procesos@show')->name('procesos')->middleware('hasModRol:35,1');

  Route::get('servicio/nuevo', 'Servicios@create')->name('servicio.create')->middleware('hasModRol:35,2');
  Route::post('servicio/nuevo', 'Servicios@store')->name('servicio.store')->middleware('hasModRol:35,2');
  Route::get('servicio/modificar/{servicio}', 'Servicios@edit')->name('servicio.edit')->middleware('hasModRol:35,3');
  Route::put('servicio/modificar/{servicio}', 'Servicios@update')->name('servicio.update')->middleware('hasModRol:35,3');

  Route::get('subservicio/nuevo', 'Subservicios@create')->name('subservicio.create')->middleware('hasModRol:35,2');
  Route::post('subservicio/nuevo', 'Subservicios@store')->name('subservicio.store')->middleware('hasModRol:35,2');
  Route::get('subservicio/modificar/{subservicio}', 'Subservicios@edit')->name('subservicio.edit')->middleware('hasModRol:35,3');
  Route::put('subservicio/modificar/{subservicio}', 'Subservicios@update')->name('subservicio.update')->middleware('hasModRol:35,3');

  Route::post('area/nuevo', 'Areas@store')->name('area.store')->middleware('hasModRol:35,2');
  Route::put('area/modificar/{area}', 'Areas@update')->name('area.update')->middleware('hasModRol:35,3');

  // MATERIALES
  Route::get('materiales', 'Materiales@show')->name('materiales')->middleware('hasModRol:36,1');
  Route::get('material/nuevo', 'Materiales@create')->name('material.create')->middleware('hasModRol:36,2');
  Route::post('material/nuevo', 'Materiales@store')->name('material.store')->middleware('hasModRol:36,2');
  Route::get('material/modificar/{material}', 'Materiales@edit')->name('material.edit')->middleware('hasModRol:36,3');
  Route::put('material/modificar/{material}', 'Materiales@update')->name('material.update')->middleware('hasModRol:36,3');

  Route::post('categoria/nuevo', 'Categorias@store')->name('categoria.store')->middleware('hasModRol:36,2');
  Route::put('categoria/modificar/{categoria}', 'Categorias@update')->name('categoria.update')->middleware('hasModRol:36,3');

  Route::post('tinta/nuevo', 'Tintas@store')->name('tinta.store')->middleware('hasModRol:36,2');
  Route::put('tinta/modificar/{tinta}', 'Tintas@update')->name('tinta.update')->middleware('hasModRol:36,3');

  // PROVEEDORES
  Route::post('proveedor', 'Proveedores@store')->name('proveedor.store')->middleware('hasModRol:30,2');
});
