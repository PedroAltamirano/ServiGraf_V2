<?php

namespace App\Http\Controllers\Tienda;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Tienda\Categoria;

use App\Http\Requests\Tienda\StoreCategoria;
use App\Http\Requests\Tienda\UpdateCategoria;

class CategoriaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
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
  public function store(StoreCategoria $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  Categoria $categoria
   * @return \Illuminate\Http\Response
   */
  public function show(Categoria $categoria)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  Categoria $categoria
   * @return \Illuminate\Http\Response
   */
  public function edit(Categoria $categoria)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  Categoria $categoria
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateCategoria $request, Categoria $categoria)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Categoria $categoria
   * @return \Illuminate\Http\Response
   */
  public function destroy(Categoria $categoria)
  {
    //
  }
}
