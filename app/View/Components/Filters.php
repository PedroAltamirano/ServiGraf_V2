<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

use App\Models\Ventas\Cliente;

class Filters extends Component
{
  public $cli;
  public $cob;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($cli = true, $cob = true)
  {
    $this->cli = $cli;
    $this->cob = $cob;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|string
   */
  public function render()
  {
    return view('components.filters');
  }
}
