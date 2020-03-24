<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Landing.welcome');
})->name('welcome');

Route::get('/about-us', function () {
    return view('Landing.about-us');
})->name('about-us');

Route::get('/services', function () {
    return view('Landing.services');
})->name('services');

Route::get('/galery', function () {
    return view('Landing.galery');
})->name('galery');

Route::get('/contact', function () {
    return view('Landing.contact');
})->name('contact');
Route::post('/contact', 'contactMail@send')->name('contact.send');

//LOGED ROUTES
Auth::routes();
Route::get('/login', 'Auth\LoginController@show')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login');

Route::get('/desktop', 'Desktop@admin_index')->name('desktop');
Route::get('/tablero', 'Desktop@index')->name('tablero');

//ADMINISTRACION
Route::get('/facturacion', 'Administracion\Facturacion@show')->name('facturacion');
Route::get('/libro', 'Administracion\Libro@show')->name('libro');
Route::get('/rrhh', 'Administracion\RRHH@show')->name('rrhh');

//PRODUCCION
Route::get('/ots', 'Produccion\Ots@show')->name('ots');
Route::get('/reporte/ots', 'Produccion\Reportes@showOts')->name('reporte/ots');
Route::get('/reporte/pagos', 'Produccion\Reportes@showPagos')->name('reporte/pagos');
Route::get('/reporte/maquinas', 'Produccion\Reportes@showMaquinas')->name('reporte/maquinas');
Route::get('/procesos', 'Produccion\Procesos@show')->name('procesos');
Route::get('/materiales', 'Produccion\Materiales@show')->name('materiales');

//USUARIOS;
Route::get('/perfiles', 'Usuarios\Perfiles@show')->name('perfiles');
Route::get('/usuarios', 'Usuarios\Usuarios@show')->name('usuarios');

//SISTEMA
Route::get('/horarios', 'Horarios@show')->name('horarios');
Route::get('/empresa', 'Empresa@show')->name('empresa');
Route::get('/claves', 'Claves@show')->name('claves');