<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Crud extends Component
{
  public $status;
  public $routeSee;
  public $modalSee;
  public $routeEdit;
  public $modalEdit;
  public $routeDelete;
  public $textDelete;
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($status = 1, $routeSee = '#', $modalSee = null, $routeEdit = '#', $modalEdit = null, $routeDelete = '#', $textDelete = '')
  {
    $this->status = $status;
    $this->routeSee = $routeSee;
    $this->modalSee = $modalSee;
    $this->routeEdit = $routeEdit;
    $this->modalEdit = $modalEdit;
    $this->routeDelete = $routeDelete;
    $this->textDelete = $textDelete;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.crud');
  }
}
