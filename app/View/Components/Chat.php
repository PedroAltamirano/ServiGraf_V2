<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Chat extends Component
{
  public $avatar;
  public $nombre;
  public $mssg;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($avatar = '', $nombre = '', $mssg = '')
  {
    $this->avatar = $avatar;
    $this->nombre = $nombre;
    $this->mssg = $mssg;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.chat');
  }
}
