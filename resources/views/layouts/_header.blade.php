@php
$now = date('H:i:s');
$horario = session('userInfo.horario');
$see_horario = false;
$text = 'Trabajando...';
if (!session('userInfo.horas')) {
    $asis_class = App\Models\Administracion\Asistencia::class;
    $asistencia =
        $asis_class
            ::where('empresa_id', Auth::user()->empresa_id)
            ->where('usuario_id', Auth::id())
            ->where('fecha', date('Y-m-d'))
            ->first() ?? new $asis_class();

    $cond = !$asistencia->llegada_mañana && $now >= $horario['llegada_ma'][0] && $now <= $horario['llegada_ma'][1];
    $cond2 = !$asistencia->salida_mañana && $now >= $horario['salida_ma'][0] && $now <= $horario['salida_ma'][1];
    $cond3 = $now > $horario['salida_ma'][1] && $now < $horario['llegada_ta'][0];
    $cond4 = !$asistencia->llegada_tarde && $now >= $horario['llegada_ta'][0] && $now <= $horario['llegada_ta'][1];
    $cond5 = !$asistencia->salida_tarde && $now >= $horario['salida_ta'][0] && $now <= $horario['salida_ta'][1];
    $cond6 = $now > $horario['salida_ta'][1] || $now < $horario['llegada_ma'][0];
    if ($cond) {
        $text = 'Marcar Entrada';
        $see_horario = true;
    } elseif ($cond2) {
        $text = 'Marcar Salida';
        $see_horario = true;
    } elseif ($cond3) {
        $text = 'Descanso...';
    } elseif ($cond4) {
        $text = 'Marcar Entrada';
        $see_horario = true;
    } elseif ($cond5) {
        $text = 'Marcar Salida';
        $see_horario = true;
    } elseif ($cond6) {
        $text = 'Casita...';
    }
}
@endphp

<nav
  class="navbar navbar-expand navbar-dark bg-primary d-flex justify-content-lg-between sticky-top shadow d-print-none">
  <button class="btn btn-link btn-sm text-white order-0 mr-3" id="sidebarToggle">
    <i class="fas fa-bars"></i>
  </button>
  <a class="navbar-brand mr-1" href="{{ Route('desktop') }}"
    id="nombre_empresa">{{ session('userInfo.empresa') }}</a>
  <ul class="navbar-nav ml-auto">
    <x-notificaciones />
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="fas fa-user-circle fa-fw"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right animated--grow-in" aria-labelledby="userDropdown">
        <h6 class="dropdown-header">Bienvenido {{ session('userInfo.nomina') }}</h6>
        @if ($see_horario)
          <a class="dropdown-item" href="{{ route('asistencia.marcar') }}">{{ $text }}</a>
        @else
          <a class="dropdown-item" href="#">{{ $text }}</a>
        @endif
        <a class="dropdown-item" href="#">Ajustes</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">Salir</a>
      </div>
    </li>
  </ul>
</nav>
