<?php

Route::as('kpi.')
  ->middleware('hasModRol:20,1')
  ->prefix('kpi')
  ->group(function () {
    Route::get('facturado', 'KPIController@kpi_facturado')->name('facturado');
    Route::get('utilidad', 'KPIController@kpi_utilidad')->name('utilidad');
    Route::get('cobrar', 'KPIController@kpi_cobrar')->name('cobrar');
    Route::get('lob_facturacion', 'KPIController@kpi_lob_facturacion')->name('lob_facturacion');
    Route::get('maquinas', 'KPIController@kpi_maquinas')->name('maquinas');
    Route::get('ots', 'KPIController@kpi_ots')->name('ots');
    Route::get('lob_ots', 'KPIController@kpi_lob_ots')->name('lob_ots');
    Route::get('cotizado', 'KPIController@kpi_cotizado')->name('cotizado');
  });
