<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Produccion\Pedido;


class YearPred extends Component
{

  public $years = 5;
  public $months;
  public $colors;
  // public $prediction;
  public $actual;
  public $average;
  public $yearly;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct()
  {
    $start = Carbon::now()->startOfYear()->format('Y-m-d');
    $end = Carbon::now()->endOfYear()->format('Y-m-d');
    $start_pred = Carbon::now()->subYear($this->years)->startOfYear()->format('Y-m-d');
    $end_pred = Carbon::now()->subYear(1)->endOfYear()->format('Y-m-d');

    $this->months = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];

    $this->colors = ['#6610f2', '#e74a3b', '#fd7e14', '#f6c23e', '#1cc88a', '#36b9cc'];

    // $this->prediction = ;

    $years = Pedido::select(DB::raw("Year(fecha_entrada) as years"))->distinct()->get()->count() - 1;

    $this->actual = Pedido::whereBetween('fecha_entrada', [$start, $end])->select(DB::raw('(sum(total_pedido)) as total'), DB::raw("MONTH(fecha_entrada) as month"))->groupBy('month')->orderBy('month', 'asc')->get();

    $this->average = Pedido::whereBetween('fecha_entrada', [$start_pred, $end_pred])->select(DB::raw("(sum(total_pedido) / {$years}) as total"), DB::raw("MONTH(fecha_entrada) as month"))->orderBy('month', 'asc')->groupBy('month')->get();

    $this->yearly = Pedido::whereBetween('fecha_entrada', [$start_pred, $end_pred])->select(DB::raw("(sum(total_pedido)) as total"), DB::raw("MONTH(fecha_entrada) as month"), DB::raw("Year(fecha_entrada) as year"))->orderBy('year', 'asc')->orderBy('month', 'asc')->groupBy('year', 'month')->get()->groupBy('year');
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|string
   */
  public function render()
  {
    return view('components.year-pred');
  }
}
