<?php

namespace App\View\Components;

use Illuminate\View\Component;

class kpi extends Component
{
  public $title;
  public $value;
  public $icon;
  public $color;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $value, $icon, $color = 'primary')
    {
      $this->title = $title;
      $this->value = $value;
      $this->icon = $icon;
      $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
      return view('components.kpi');
    }
}
