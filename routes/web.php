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
Route::get('/test', function () {
  return view('test');
})->name('test');

//LOGED ROUTES
Auth::routes();
Route::get('/login', 'Auth\LoginController@show')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware('auth')
  ->group(function () {
    Route::get('/desktop', 'DesktopController@showAdmin')->name('desktop')->middleware('hasModRol:10,1');

    Route::get('/tablero', 'DesktopController@show')->name('tablero');

    Route::get('cloud', function () {
      return view('cloud');
    })->name('cloud');

    Route::get('mail', function () {
      return view('mail');
    })->name('mail');

    // KPIs
    include('kpis.php');

    //ADMINISTRACION
    include('administracion.php');

    //PRODUCCION
    include('produccion.php');

    //VENTAS
    include('ventas.php');

    //USUARIOS;
    include('usuarios.php');

    //SISTEMA
    include('sistema.php');
  });
