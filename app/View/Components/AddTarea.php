<?php

namespace App\View\Components;

use App\Models\Usuarios\Usuario;
use App\Models\Ventas\Actividad;
use App\Models\Ventas\Cliente_empresa;
use App\Models\Ventas\Contacto;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class AddTarea extends Component
{
  public $empresas;
  public $actividades;
  public $usuarios;
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->empresas = Cliente_empresa::where('empresa_id', Auth::user()->empresa_id)->orderBy('nombre')->with('contactos')->get();
    $this->actividades = Actividad::where('empresa_id', Auth::user()->empresa_id)->get();
    $this->usuarios = Usuario::where('status', 1)->where('empresa_id', Auth::user()->empresa_id)->get();
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.add-tarea');
  }
}
