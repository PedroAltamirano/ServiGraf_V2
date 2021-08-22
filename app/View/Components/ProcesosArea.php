<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Produccion\Proceso;
use Illuminate\Support\Facades\Auth;

class ProcesosArea extends Component
{
  public $name;
  public $id;
  public $old;
  public $list;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $old, $id)
    {
      $this->id = $id;
      $this->name = $name;
      $this->old = $old;
      $this->list = Proceso::where('empresa_id', Auth::user()->empresa_id)->where('parent_id', null)->get()->groupBy('area_id');
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
