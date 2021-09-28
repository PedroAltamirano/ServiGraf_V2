<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Notificaciones extends Component
{
  public $notificaciones;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->notificaciones = Auth::user()->notifications;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.notificaciones');
  }
}
