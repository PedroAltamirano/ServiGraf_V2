<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RecusiveOptions extends Component
{
  public $parent;
  public $column;
  public $old;
  public $list;
  public $with_parent;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($parent = '', $column = 'name', $old = '', $list, $with_parent = 1)
    {
      $this->parent = $parent;
      $this->column = $column;
      $this->old = $old;
      $this->list = $list;
      $this->with_parent = $with_parent;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.recusive-options');
    }
}
