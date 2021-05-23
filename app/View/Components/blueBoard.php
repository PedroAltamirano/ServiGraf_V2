<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BlueBoard extends Component
{
    public $title;
    public $foot;
    public $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $foot, $class='')
    {
        $this->title = $title;
        $this->foot = $foot;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.blueBoard');
    }
}
