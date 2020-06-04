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

//PHP TEST
Route::get('/test', function(){
    return view('test');
})->name('test');

//LOGED ROUTES
Auth::routes();
Route::get('/login', 'Auth\LoginController@show')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/desktop', 'Desktop@showAdmin')->name('desktop');
Route::get('/tablero', 'Desktop@show')->name('tablero');

//ADMINISTRACION
Route::get('/facturacion', 'Administracion\Facturacion@show')->name('facturacion');
Route::get('/getFacturas', 'Administracion\Facturacion@getFacts')->name('getFacturacion');
Route::get('/libro', 'Administracion\Libro@show')->name('libro');
Route::get('/rrhh', 'Administracion\RRHH@show')->name('rrhh');

//PRODUCCION
Route::get('/pedidos', 'Produccion\Pedidos@show')->name('pedidos');
Route::get('/pedidos/get', 'Produccion\Pedidos@get')->name('pedidos.get');
Route::get('/pedido/nuevo', 'Produccion\Pedidos@newGet')->name('pedido.nuevo');
Route::post('/pedido/nuevo', 'Produccion\Pedidos@newPost')->name('pedido.nuevo');
Route::get('/pedido/modificar/{pedido_id}', 'Produccion\Pedidos@modGet')->name('pedido.modificar');
Route::post('/pedido/modificar/{pedido_id}', 'Produccion\Pedidos@modPost')->name('pedido.modificar');

Route::get('/reporte/pedidos', 'Produccion\Reportes@showPedidos')->name('reporte.pedidos');
Route::get('/reporte/pagos', 'Produccion\Reportes@showPagos')->name('reporte.pagos');
Route::get('/reporte/maquinas', 'Produccion\Reportes@showMaquinas')->name('reporte.maquinas');

Route::get('/procesos', 'Produccion\Procesos@show')->name('procesos');
Route::get('/materiales', 'Produccion\Materiales@show')->name('materiales');

//VENTAS
Route::post('/ventas/telefono', 'Ventas\Clientes@telefono')->name('cliente.telefono');

//USUARIOS;
Route::get('/perfiles', 'Usuarios\Perfiles@show')->name('perfiles');
Route::get('/perfiles/get', 'Usuarios\Perfiles@get')->name('perfiles.get');
Route::get('/perfil/nuevo', 'Usuarios\Perfiles@newGet')->name('perfil.nuevo');
Route::post('/perfil/nuevo', 'Usuarios\Perfiles@newPost')->name('perfil.nuevo');
Route::get('/perfil/modificar/{perfil_id}', 'Usuarios\Perfiles@modGet')->name('perfil.modificar');
Route::post('/perfil/modificar/{perfil_id}', 'Usuarios\Perfiles@modPost')->name('perfil.modificar');

Route::get('/usuarios', 'Usuarios\Usuarios@show')->name('usuarios');
Route::get('/usuarios/get', 'Usuarios\Usuarios@get')->name('usuarios.get');
Route::get('/usuario/nuevo', 'Usuarios\Usuarios@newGet')->name('usuario.nuevo');
Route::post('/usuario/nuevo', 'Usuarios\Usuarios@newPost')->name('usuario.nuevo');
Route::get('/usuario/modificar/{usuario_id}', 'Usuarios\Usuarios@modGet')->name('usuario.modificar');
Route::post('/usuario/modificar/{usuario_id}', 'Usuarios\Usuarios@modPost')->name('usuario.modificar');

//SISTEMA
Route::get('/horarios', 'Horarios@show')->name('horarios');
Route::get('/empresa', 'Empresa@show')->name('empresa');
Route::get('/claves', 'Claves@show')->name('claves');