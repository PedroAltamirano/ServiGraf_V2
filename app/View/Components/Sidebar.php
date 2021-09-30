<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Sidebar extends Component
{
  public $modulos;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->modulos = Auth::user()->modulos->pluck('modulo_id')->toArray() ?? [];
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.sidebar');
  }
}
