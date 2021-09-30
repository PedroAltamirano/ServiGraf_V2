<?php

namespace App\View\Components;

use App\Models\Usuarios\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Usuarios extends Component
{
  public $id;
  public $name;
  public $usuarios;
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($id = '', $name = '')
  {
    $this->id = $id;
    $this->name = $name;
    $this->usuarios = Usuario::where('empresa_id', Auth::user()->empresa_id)->where('status', 1)->with('nomina')->get();
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.usuarios');
  }
}
