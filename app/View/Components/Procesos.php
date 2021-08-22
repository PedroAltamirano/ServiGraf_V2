<?php

namespace App\View\Components;

use App\Models\Produccion\Proceso;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Procesos extends Component
{
  public $label;
  public $name;
  public $old;
  public $list;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name, $old)
    {
      $this->label = $label;
      $this->name = $name;
      $this->old = $old;
      $this->list = Proceso::where('empresa_id', Auth::user()->empresa_id)->where('parent_id', null)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.procesos');
    }
}
