<ul class="navbar-nav sidebar sidebar-dark accordion toggled d-print-none" id="accordionSidebar">

  <!-- tablero -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('tablero') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Tablero</span>
    </a>
  </li>

  <!-- administracion -->
  @if (in_array('20', $modulos))
    <li class="nav-item">
      <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseAdmin" aria-expanded="true"
        aria-controls="collapseTwo">
        <i class="fas fa-fw fa-chart-line"></i>
        <span>Administración</span>
      </a>
      <div id="collapseAdmin" class="dropdown-menu collapse" aria-labelledby="headingTwo"
        data-parent="#accordionSidebar">
        @if (in_array('21', $modulos))
          <a class="dropdown-item" href="{{ route('facturacion') }}">Facturación</a>
        @endif
        @if (in_array('23', $modulos))
          <a class="dropdown-item" href="{{ route('libro') }}">Libro diario</a>
        @endif
        <div class="dropdown-divider"></div>
        <h6 class="dropdown-header">RRHH:</h6>
        @if (in_array('24', $modulos))
          <a class="dropdown-item" href="{{ route('nomina') }}">Nomina</a>
        @endif
        @if (in_array('25', $modulos))
          <a class="dropdown-item" href="{{ route('rrhh') }}">Asistencia</a>
        @endif
      </div>
    </li>
  @endif

  <!-- produccion -->
  @if (in_array('30', $modulos))
    <li class="nav-item">
      <a class="nav-link collapsed" data-toggle="collapse" aria-expanded="true" data-target="#collapseProd"
        aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cogs"></i>
        <span>Producción</span>
      </a>
      <div id="collapseProd" class="dropdown-menu collapse" aria-labelledby="headingTwo"
        data-parent="#accordionSidebar">
        <a class="dropdown-item" href="{{ route('pedidos') }}">Pedidos</a>
        <div class="dropdown-divider"></div>
        <h6 class="dropdown-header">Reportes:</h6>
        @if (in_array('32', $modulos))
          <a class="dropdown-item" href="{{ route('reporte.pedidos') }}">Pedidos</a>
        @endif
        @if (in_array('33', $modulos))
          <a class="dropdown-item" href="{{ route('reporte.pagos') }}">Pagos</a>
        @endif
        @if (in_array('34', $modulos))
          <a class="dropdown-item" href="{{ route('reporte.maquinas') }}">Máquinas</a>
        @endif
        <div class="dropdown-divider"></div>
        <h6 class="dropdown-header">Inventario:</h6>
        @if (in_array('35', $modulos))
          <a class="dropdown-item" href="{{ route('procesos') }}">Procesos</a>
        @endif
        @if (in_array('36', $modulos))
          <a class="dropdown-item" href="{{ route('materiales') }}">Materiales</a>
        @endif
      </div>
    </li>
  @endif

  <!-- cloud -->
  @if (in_array('40', $modulos))
    <li class="nav-item">
      <a class="nav-link" href="{{ route('cloud') }}">
        <i class="fas fa-fw fa-cloud"></i>
        <span>Cloud</span></a>
    </li>
  @endif

  <!-- mail -->
  @if (in_array('45', $modulos))
    <li class="nav-item">
      <a class="nav-link" href="{{ route('mail') }}">
        <i class="fas fa-fw fa-envelope"></i>
        <span>Mail</span></a>
    </li>
  @endif

  <!-- ventas -->
  @if (in_array('50', $modulos))
    <li class="nav-item">
      <a class="nav-link collapsed" data-toggle="collapse" aria-expanded="true" data-target="#collapseSales"
        aria-controls="collapseTwo">
        <i class="fas fa-fw fa-dollar-sign"></i>
        <span>Ventas</span>
      </a>
      <div class="dropdown-menu collapse" id="collapseSales" aria-labelledby="headingTwo"
        data-parent="#accordionSidebar">
        <a class="dropdown-item" href="{{ route('crm') }}">CRM</a>
        @if (in_array('51', $modulos))
          <a class="dropdown-item" href="{{ route('actividad') }}">Actividades</a>
        @endif
        @if (in_array('52', $modulos))
          <a class="dropdown-item" href="{{ route('contacto') }}">Contactos</a>
        @endif
        @if (in_array('53', $modulos))
          <a class="dropdown-item" href="{{ route('plantilla') }}">Plantillas</a>
        @endif
        @if (in_array('54', $modulos))
          <a class="dropdown-item" href="#">Evaluación</a>
        @endif
      </div>
    </li>
  @endif

  <!-- tienda -->
  @if (in_array('60', $modulos))
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="fas fa-fw fa-store"></i>
        <span>Tienda</span></a>
    </li>
  @endif

  <!-- usuarios -->
  @if (in_array('70', $modulos))
    <li class="nav-item">
      <a class="nav-link collapsed" data-toggle="collapse" aria-expanded="true" data-target="#collapseUsers"
        aria-controls="collapseTwo">
        <i class="fas fa-fw fa-user"></i>
        <span>Usuarios</span>
      </a>
      <div class="dropdown-menu collapse" id="collapseUsers" aria-labelledby="headingTwo"
        data-parent="#accordionSidebar">
        <a class="dropdown-item" href="{{ route('usuarios') }}">Usuarios</a>
        @if (in_array('71', $modulos))
          <a class="dropdown-item" href="{{ route('perfiles') }}">Perfiles</a>
        @endif
      </div>
    </li>
  @endif

  <!-- sistema -->
  @if (in_array('80', $modulos))
    <li class="nav-item">
      <a class="nav-link collapsed" data-toggle="collapse" aria-expanded="true" data-target="#collapseSys"
        aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Sistema</span>
      </a>
      <div class="dropdown-menu collapse" id="collapseSys" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        {{-- <a class="dropdown-item" href="{{ route('horarios') }}">Horarios</a> --}}
        <a class="dropdown-item" href="{{ route('empresa') }}">Mi empresa</a>
        @if (in_array('81', $modulos))
          <a class="dropdown-item" href="{{ route('facturacion-empresas') }}">Facturación</a>
        @endif
        @if (in_array('82', $modulos))
          <a class="dropdown-item confirmModal" href="#confirmModal" data-route="{{ route('claves') }}"
            data-toggle="modal">Claves</a>
        @endif
        @if (auth()->user()->is_superadmin)
          <a class="dropdown-item" href="{{ route('empresas') }}">Empresas</a>
        @endif
      </div>
    </li>
  @endif
</ul>
