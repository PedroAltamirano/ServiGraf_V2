<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Sistema de producción resposive">
  <meta name="author" content="Pedro Andrés Altamirano López">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!--icono-->
  <link href="{{ asset('img/sg-2.png') }}" rel="icon" type="text/css">

  <title>{{ __('ServiGraf app') }}</title>

  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  
  <!--link href="{{ asset('css/app.css') }}" rel="stylesheet"-->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
  <!--layout-->
  <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
  <!--datatable-->
  <link href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
  <!--FAB-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  @yield('links')

</head>

<body>

  <nav class="navbar navbar-expand navbar-dark bg-primary static-top d-flex justify-content-lg-between sticky-top shadow">
    <!-- toggle -->
    <button class="btn btn-link btn-sm text-white order-0 mr-3" id="sidebarToggle" href="">
      <i class="fas fa-bars"></i>
    </button>
  <a class="navbar-brand mr-1" href="{{ Route('desktop') }}" id="nombre_empresa">{{ $nombre_empresa }}</a>
    <!-- Navbar -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown no-arrow mx-1">
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
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <h6 class="dropdown-header">Bienvenido {{ Auth::guard('usuario')->user()->nombre }}</h6>
          <a class="dropdown-item" href="#">Timbrar</a>
          <a class="dropdown-item" href="#">Ajustes</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Salir</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">

      <!-- tablero -->
      <li class="nav-item">
      <a class="nav-link" href="{{Route('tablero')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Tablero</span>
        </a>
      </li>

      <!-- administracion -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-chart-line"></i>
          <span>Administración</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="/facturacion">Facturación</a>
          <a class="dropdown-item" href="/libro">Libro diario</a>
          <a class="dropdown-item" href="/rrhh">RRHH</a>
        </div>
      </li>

      <!-- produccion -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-cogs"></i>
          <span>Producción</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="/ots">OT</a>
          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">Reportes:</h6>
          <a class="dropdown-item" href="/reporte/ots">Ot´s</a>
          <a class="dropdown-item" href="/reporte/pagos">Pagos</a>
          <a class="dropdown-item" href="/reporte/maquinas">Máquinas</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/procesos">Procesos</a>
          <a class="dropdown-item" href="/materiales">Materiales</a>
        </div>
      </li>

      <!-- cloud -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-cloud"></i>
          <span>Cloud</span></a>
      </li>

      <!-- mail -->
      <li class="nav-item">
        <a class="nav-link" href="https://webmail.gandi.net/SOGo/">
          <i class="fas fa-fw fa-envelope"></i>
          <span>Mail</span></a>
      </li>

      <!-- ventas -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>Ventas</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="#">CRM</a>
          <a class="dropdown-item" href="#">Actividades</a>
          <a class="dropdown-item" href="#">Contactos</a>
          <a class="dropdown-item" href="#">Plantillas</a>
          <a class="dropdown-item" href="#">Evaluación</a>
        </div>
      </li>

      <!-- usuarios -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-user"></i>
          <span>Usuarios</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="/perfiles">Perfiles</a>
          <a class="dropdown-item" href="/usuarios">Usuarios</a>
        </div>
      </li>

      <!-- sistema -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-cog"></i>
          <span>Sistema</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="/horarios">Horarios</a>
          <a class="dropdown-item" href="/empresa">Mi empresa</a>
          <a class="dropdown-item" href="/claves">Claves</a>
        </div>
      </li>
    </ul>

    <div id="content-wrapper" class="p-0 m-0">
      <div class="p-2 p-md-3 m-0" id="app">
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
  <div id="fab">
    <fab-comp></fab-comp>
  </div>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
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
					
					<a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						Salir
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>

        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/sb-admin.min.js') }}"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

  <!--script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script-->

  <script>
    const fab = new Vue({
      el: '#fab',
    });
  </script>

  @yield('scripts')

</body>

</html>
