<?php

namespace App\View\Components;

use Carbon\Carbon;
use Illuminate\View\Component;

class Chat extends Component
{
  public $avatar;
  public $nombre;
  public $fecha;
  public $mssg;
  public $parentId;
  public $modaldata;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($avatar = '', $nombre = '', $fecha = '', $mssg = '', $parentId = null, $modaldata = null)
  {
    $this->avatar = $avatar;
    $this->nombre = $nombre;
    $fecha = new Carbon($fecha);
    $this->fecha = $fecha->format('Y-m-d H:i:s');
    $this->mssg = $mssg;
    $this->parentId = $parentId;
    $this->modaldata = $modaldata;
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
