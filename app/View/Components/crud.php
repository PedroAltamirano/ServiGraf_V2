<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Crud extends Component
{
  public $routeSee;
  public $modalSee;
  public $classSee;
  public $routeEdit;
  public $modalEdit;
  public $classEdit;
  public $routeDelete;
  public $textDelete;
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($routeSee = '#', $modalSee = null, $classSee = '', $routeEdit = '#', $modalEdit = null, $classEdit = '', $routeDelete = '#', $textDelete = '')
  {
    $this->routeSee = $routeSee;
    $this->modalSee = $modalSee;
    $this->classSee = $classSee;
    $this->routeEdit = $routeEdit;
    $this->modalEdit = $modalEdit;
    $this->classEdit = $classEdit;
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
