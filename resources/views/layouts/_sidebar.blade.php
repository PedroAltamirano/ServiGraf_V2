<ul class="navbar-nav sidebar sidebar-dark accordion toggled d-print-none" id="accordionSidebar">

  <!-- tablero -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('tablero') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Tablero</span>
    </a>
  </li>

  <?php use App\Security; ?>

  <!-- administracion -->
  @if(Security::hasModule('20'))
  <li class="nav-item">
    <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseAdmin" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-chart-line"></i>
      <span>Administración</span>
    </a>
    <div id="collapseAdmin" class="dropdown-menu collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      @if(Security::hasModule('21'))
      <a class="dropdown-item" href="{{ route('facturacion') }}">Facturación</a>
      @endif
      @if(Security::hasModule('23'))
      <a class="dropdown-item" href="{{ route('libro') }}">Libro diario</a>
      @endif
      <div class="dropdown-divider"></div>
      <h6 class="dropdown-header">RRHH:</h6>
      @if(Security::hasModule('24'))
      <a class="dropdown-item" href="{{ route('nomina') }}">Nomina</a>
      @endif
      @if(Security::hasModule('25'))
      <a class="dropdown-item" href="{{ route('rrhh') }}">Asistencia</a>
      @endif
    </div>
  </li>
  @endif

  <!-- produccion -->
  @if(Security::hasModule('30'))
  <li class="nav-item">
    <a class="nav-link collapsed" data-toggle="collapse" aria-expanded="true" data-target="#collapseProd" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cogs"></i>
      <span>Producción</span>
    </a>
    <div id="collapseProd" class="dropdown-menu collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <a class="dropdown-item" href="{{ route('pedidos') }}">Pedidos</a>
      <div class="dropdown-divider"></div>
      <h6 class="dropdown-header">Reportes:</h6>
      @if(Security::hasModule('32'))
      <a class="dropdown-item" href="{{ route('reporte.pedidos') }}">Pedidos</a>
      @endif
      @if(Security::hasModule('33'))
      <a class="dropdown-item" href="{{ route('reporte.pagos') }}">Pagos</a>
      @endif
      @if(Security::hasModule('34'))
      <a class="dropdown-item" href="{{ route('reporte.maquinas') }}">Máquinas</a>
      @endif
      <div class="dropdown-divider"></div>
      <h6 class="dropdown-header">Inventario:</h6>
      @if(Security::hasModule('35'))
      <a class="dropdown-item" href="{{ route('procesos') }}">Procesos</a>
      @endif
      @if(Security::hasModule('36'))
      <a class="dropdown-item" href="{{ route('materiales') }}">Materiales</a>
      @endif
    </div>
  </li>
  @endif

  <!-- cloud -->
  @if(Security::hasModule('40'))
  <li class="nav-item">
    <a class="nav-link" href="{{ route('cloud') }}">
      <i class="fas fa-fw fa-cloud"></i>
      <span>Cloud</span></a>
  </li>
  @endif

  <!-- mail -->
  @if(Security::hasModule('45'))
  <li class="nav-item">
    <a class="nav-link" href="{{ route('mail') }}">
      <i class="fas fa-fw fa-envelope"></i>
      <span>Mail</span></a>
  </li>
  @endif

  <!-- ventas -->
  @if(Security::hasModule('50'))
  <li class="nav-item">
    <a class="nav-link collapsed" data-toggle="collapse" aria-expanded="true" data-target="#collapseSales" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-dollar-sign"></i>
      <span>Ventas</span>
    </a>
    <div class="dropdown-menu collapse" id="collapseSales" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <a class="dropdown-item" href="{{ route('crm') }}">CRM</a>
      @if(Security::hasModule('51'))
      <a class="dropdown-item" href="{{ route('actividad') }}">Actividades</a>
      @endif
      @if(Security::hasModule('52'))
      <a class="dropdown-item" href="{{ route('contacto') }}">Contactos</a>
      @endif
      @if(Security::hasModule('53'))
      <a class="dropdown-item" href="{{ route('plantilla') }}">Plantillas</a>
      @endif
      @if(Security::hasModule('54'))
      <a class="dropdown-item" href="#">Evaluación</a>
      @endif
    </div>
  </li>
  @endif

  <!-- tienda -->
  @if(Security::hasModule('60'))
  <li class="nav-item">
    <a class="nav-link" href="#">
      <i class="fas fa-fw fa-store"></i>
      <span>Tienda</span></a>
  </li>
  @endif

  <!-- usuarios -->
  @if(Security::hasModule('70'))
  <li class="nav-item">
    <a class="nav-link collapsed" data-toggle="collapse" aria-expanded="true" data-target="#collapseUsers" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-user"></i>
      <span>Usuarios</span>
    </a>
    <div class="dropdown-menu collapse" id="collapseUsers" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <a class="dropdown-item" href="{{ route('usuarios') }}">Usuarios</a>
      @if(Security::hasModule('71'))
      <a class="dropdown-item" href="{{ route('perfiles') }}">Perfiles</a>
      @endif
    </div>
  </li>
  @endif

  <!-- sistema -->
  @if(Security::hasModule('80'))
  <li class="nav-item">
    <a class="nav-link collapsed" data-toggle="collapse" aria-expanded="true" data-target="#collapseSys" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Sistema</span>
    </a>
    <div class="dropdown-menu collapse" id="collapseSys" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      {{-- <a class="dropdown-item" href="{{ route('horarios') }}">Horarios</a> --}}
      <a class="dropdown-item" href="{{ route('empresa') }}">Mi empresa</a>
      @if(Security::hasModule('81'))
      <a class="dropdown-item" href="{{ route('facturacion-empresas') }}">Facturación</a>
      @endif
      @if(Security::hasModule('82'))
      <a class="dropdown-item confirmModal" href="#confirmModal" data-route="{{ route('claves') }}" data-toggle="modal">Claves</a>
      @endif
    </div>
  </li>
  @endif
</ul>
