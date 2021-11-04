<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class IsSuperAdmin
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next)
  {
    if (Auth::user()->is_superadmin) {
      return $next($request);
    } else {
      Alert::error('NO AUTORIZADO', 'No estas autorizado a realizar esta accion.');
      return redirect()->route('tablero');
    }
  }
}
