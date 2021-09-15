<?php

namespace App\View\Components;

use App\Models\Ventas\Cliente_empresa;
use Illuminate\View\Component;

use App\Models\Ventas\Contacto;

class AddContacto extends Component
{
  public $contacto;
  public $empresa;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->contacto = new Contacto();
    $this->empresa = new Cliente_empresa();
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|string
   */
  public function render()
  {
    return view('components.add-contacto');
  }
}
