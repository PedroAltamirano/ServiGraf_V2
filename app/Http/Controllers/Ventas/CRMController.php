<?php

namespace App\Http\Controllers\Ventas;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Ventas\CRM;
use Carbon\Carbon;

class CRMController extends Controller
{
  use SoftDeletes;

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $query = CRM::where('empresa_id', Auth::user()->empresa_id)
      ->where('estado', 0)
      ->where(function ($query) {
        $query->orWhere('creador_id', Auth::id());
        $query->orWhere('asignado_id', Auth::id());
      })
      ->orderBy('hora', 'asc');

    $atrasadas = clone $query;
    $atrasadas = $atrasadas->where('fecha', '<', date('Y-m-d'))->get();

    $hoy = clone $query;
    $hoy = $hoy->where('fecha', '=', date('Y-m-d'))->get();

    $tomorrow = Carbon::now()->addDays(1)->format('Y-m-d');
    $endweek = Carbon::now()->endOfWeek()->format('Y-m-d');
    $semana = clone $query;
    $semana = $semana->whereBetween('fecha', [$tomorrow, $endweek])->get();

    $next = Carbon::now()->endOfWeek()->addDays(1)->format('Y-m-d');
    $proximas = clone $query;
    $proximas = $proximas->where('fecha', '>', $next)->get();

    return view('Ventas.crm', compact('atrasadas', 'hoy', 'semana', 'proximas'));
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
  public function store(Request $request)
  {
    Alert::success('Acción completada', 'Evento creado con éxito');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
