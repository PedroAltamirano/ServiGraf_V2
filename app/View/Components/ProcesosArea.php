<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

use App\Models\Produccion\Proceso;
use App\Models\Produccion\Area;

class ProcesosArea extends Component
{
  public $id;
  public $name;
  public $old;
  public $list;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($name, $old, $id)
  {
    $user = Auth::user();
    $this->id = $id;
    $this->name = $name;
    $this->old = $old;
    // $this->list = Proceso::where('empresa_id', $user->empresa_id)->where('parent_id', null)->orderBy('proceso')->get()->groupBy('area_id');
    $this->list = Area::where('empresa_id', $user->empresa_id)->orderBy('orden')->get()->map(function ($area) {
      $area->procesos = $area->procesos()->orderBy('proceso')->get()->toTree();
      if ($area->procesos->count()) {
        return  $area;
      }
    });
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|string
   */
  public function render()
  {
    return view('components.procesos-area');
  }
}
