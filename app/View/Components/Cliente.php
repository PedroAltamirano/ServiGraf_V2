<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

use App\Models\Ventas\Cliente as ClienteClass;

class Cliente extends Component
{
  public $clientes;
  public $column;
  public $old;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($list = null, $column = 'cliente', $old = null)
  {
    $this->clientes = $list ?? ClienteClass::where('empresa_id', Auth::user()->empresa_id)->with(['contacto', 'empresa'])->orderBy('cliente_empresa_id')->get();
    $this->column = $column;
    $this->old = $old;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.cliente');
  }
}
