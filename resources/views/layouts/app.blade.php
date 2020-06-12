<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="ERP">
  
  <meta name="author" content="Pedro Andrés Altamirano López">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- tab icon -->
  <link href="{{ asset('img/sg-2.png') }}" rel="icon" type="text/css">

  <title>{{ __('ServiGraf app') }}</title>
  
  <!-- vue -->
  {{-- <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

  <!--layout-->
  {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
  
  <!-- datatables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>


  @yield('links')
</head>

<body class="sidebar-toggled">

  <!-- NAVEGADOR PRINCIPAL -->
  <nav class="navbar navbar-expand navbar-dark bg-primary d-flex justify-content-lg-between sticky-top shadow">
    <!-- toggle -->
    <button class="btn btn-link btn-sm text-white order-0 mr-3" id="sidebarToggle">
      <i class="fas fa-bars"></i>
    </button>
    <a class="navbar-brand mr-1" href="{{ Route('desktop') }}" id="nombre_empresa">{{ session('userInfo.empresa') }}</a>
    <!-- Navbar -->
    <ul class="navbar-nav ml-auto">
      <!-- NOTIFICATIONS -->
      <!--li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="badge badge-danger">7</span>
          <i class="fas fa-fw fa-envelope"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li-->

      <!-- USER -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <h6 class="dropdown-header">Bienvenido {{ session('userInfo.nomina') }}</h6>
          <a class="dropdown-item" href="#">Timbrar</a>
          <a class="dropdown-item" href="#">Ajustes</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">Salir</a>
        </div>
      </li>
    </ul>
  </nav>

  <div id="wrapper">

    <!-- SIDEBAR -->
    <ul class="sidebar navbar-nav toggled">

      <!-- tablero -->
      <li class="nav-item">
        <a class="nav-link" href="{{Route('tablero')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Tablero</span>
        </a>
      </li>

      <?php use App\Security; ?>

      <!-- administracion -->
      @if(Security::hasModule('20'))
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-chart-line"></i>
          <span>Administración</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          @if(Security::hasModule('21'))
          <a class="dropdown-item" href="{{Route('facturacion')}}">Facturación</a>
          @endif
          @if(Security::hasModule('22'))
          <a class="dropdown-item" href="{{Route('libro')}}">Libro diario</a>
          @endif
          @if(Security::hasModule('23'))
          <a class="dropdown-item" href="{{Route('rrhh')}}">RRHH</a>
          @endif
        </div>
      </li>
      @endif

      <!-- produccion -->
      @if(Security::hasModule('30'))
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-cogs"></i>
          <span>Producción</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="{{Route('pedidos')}}">Pedido</a>
          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">Reportes:</h6>
          @if(Security::hasModule('32'))
          <a class="dropdown-item" href="{{Route('reporte.pedidos')}}">Pedidos</a>
          @endif
          @if(Security::hasModule('33'))
          <a class="dropdown-item" href="{{Route('reporte.pagos')}}">Pagos</a>
          @endif
          @if(Security::hasModule('34'))
          <a class="dropdown-item" href="{{Route('reporte.maquinas')}}">Máquinas</a>
          @endif
          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">Inventario:</h6>
          @if(Security::hasModule('35'))
          <a class="dropdown-item" href="{{Route('procesos')}}">Procesos</a>
          @endif
          @if(Security::hasModule('36'))
          <a class="dropdown-item" href="{{Route('materiales')}}">Materiales</a>
          @endif
        </div>
      </li>
      @endif

      <!-- cloud -->
      @if(Security::hasModule('40'))
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-cloud"></i>
          <span>Cloud</span></a>
      </li>
      @endif

      <!-- mail -->
      @if(Security::hasModule('45'))
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-envelope"></i>
          <span>Mail</span></a>
      </li>
      @endif

      <!-- ventas -->
      @if(Security::hasModule('50'))
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>Ventas</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="{{Route('crm')}}">CRM</a>
          @if(Security::hasModule('51'))
          <a class="dropdown-item" href="{{Route('actividades')}}">Actividades</a>
          @endif
          @if(Security::hasModule('52'))
          <a class="dropdown-item" href="{{Route('contactos')}}">Contactos</a>
          @endif
          @if(Security::hasModule('53'))
          <a class="dropdown-item" href="{{Route('plantillas')}}">Plantillas</a>
          @endif
          @if(Security::hasModule('54'))
          <a class="dropdown-item" href="{{Route('evaluacion')}}">Evaluación</a>
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
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-user"></i>
          <span>Usuarios</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="{{Route('usuarios')}}">Usuarios</a>
          @if(Security::hasModule('71'))
          <a class="dropdown-item" href="{{Route('perfiles')}}">Perfiles</a>
          @endif
        </div>
      </li>
      @endif

      <!-- sistema -->
      @if(Security::hasModule('80'))
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-cog"></i>
          <span>Sistema</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="{{Route('horarios')}}">Horarios</a>
          <a class="dropdown-item" href="{{Route('empresa')}}">Mi empresa</a>
          <a class="dropdown-item" href="{{Route('claves')}}">Claves</a>
        </div>
      </li>
      @endif
    </ul>

    <!-- WRAPPER -->
    <div id="content-wrapper" class="p-0 m-0">
      <div class="" id="app" style="padding:0 0 40px 0;">
        @yield('desktop-content')
      </div>

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Pedro Altamirano 2019</span>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- /#wrapper -->

  <!-- floating action button -->
  <div id="fab" style="position:fixed; bottom:0; right:0;">
    <fab-comp></fab-comp>
  </div>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Listo para salir?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Selecciona "Salir" si deseas terminar con la session actual.</div>
        <div class="modal-footer">
          <button class="btn bg-light" type="button" data-dismiss="modal">Cancelar</button>
					<form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-primary"  type="submit"> Salir </button>
					</form>
        </div>
      </div>
    </div>
  </div>

  <!-- STATE MODAL -->
  @if(session('actionStatus'))
  <div class="modal fade" id="actionStatusModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ json_decode(session('actionStatus'))->title }}</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          @if(json_decode(session('actionStatus'))->type == 'success')
          <i class="far fa-check-circle fa-10x text-success w-100 text-center"></i>
          @elseif(json_decode(session('actionStatus'))->type == 'danger')
          <i class="far fa-times-circle fa-10x text-danger w-100 text-center"></i>
          @else
          <i class="far fa-question-circle fa-10x text-{{json_decode(session('actionStatus'))->type}} w-100 text-center"></i>
          @endif
          <div class="dropdown-divider"></div>
          <span class="text-{{json_decode(session('actionStatus'))->type}}">
            {{ json_decode(session('actionStatus'))->message }}
          </span>
        </div>
      </div>
    </div>
  </div>
  @endif

  <!-- ERRORS ALERT -->
  <div class="errorDiv" id="errorDiv">
    {{-- {{ session()->all() }} --}}
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show errorAlert" role="alert">
      {{ $error }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endforeach
  </div>

  @yield('modals')

  <!-- JavaScript -->
  {{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/sb-admin.js') }}"></script>
  <script src="{{ asset('js/helpers.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

  @yield('scripts')
  @yield('after.scripts')

  <script>
    $(document).ready(function(){
      

      @if($errors->any())
      $(".alert").fadeTo(10000, 0.5).slideUp(8000);
      @endif

      @yield('document.ready')
      @yield('after.document.ready')
    });
  </script>

</body>

</html>
