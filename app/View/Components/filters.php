<?php

namespace App\View\Components;

use Illuminate\View\Component;

class filters extends Component
{
  public $clientes;
  public $cli;
  public $cob;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($clientes, $cli = null, $cob = null)
  {
    $this->clientes = $clientes;
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
