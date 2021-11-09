<?php

namespace App\Http\Controllers\Tienda;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Tienda\Producto;

use App\Http\Requests\Tienda\StoreProducto;
use App\Http\Requests\Tienda\UpdateProducto;

class ProductoController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $productos = Producto::all();
    return view('Tienda.index', compact('productos'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreProducto $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Producto  $producto
   * @return \Illuminate\Http\Response
   */
  public function show(Producto $producto)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Producto  $producto
   * @return \Illuminate\Http\Response
   */
  public function edit(Producto $producto)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Producto  $producto
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateProducto $request, Producto $producto)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Producto  $producto
   * @return \Illuminate\Http\Response
   */
  public function destroy(Producto $producto)
  {
    //
  }
}
