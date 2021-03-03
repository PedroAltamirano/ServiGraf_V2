<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Produccion\Pedido;

class modalPedido extends Component
{
  public $pedido;
  public $method;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($id = null)
  {
    $this->pedido = $id ? Pedido::find($id) : new Pedido;
    $this->method = 'PUT';
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|string
   */
  public function render()
  {
      return view('components.modalPedido');
  }
}
