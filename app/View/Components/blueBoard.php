<?php

namespace App\View\Components;

use Illuminate\View\Component;

class blueBoard extends Component
{
    public $title;
    public $foot;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $foot)
    {
        $this->title = $title;
        $this->foot = $foot;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.blue-board');
    }
}
