<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="ERP">

  <meta name="author" content="Pedro Andrés Altamirano López">
  <link href="{{ asset('img/sg-2.png') }}" rel="icon" type="text/css">

  <title>{{ __('ServiGraf app') }}</title>

  <!-- ASSETS -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/desktop.css') }}" rel="stylesheet">
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

  @yield('links')
</head>

<body class="sidebar-toggled">
  <!-- ERRORS ALERT -->
  <x-errors />

  <nav class="navbar navbar-expand navbar-dark bg-primary d-flex justify-content-lg-between sticky-top shadow d-print-none">
    <button class="btn btn-link btn-sm text-white order-0 mr-3" id="sidebarToggle">
      <i class="fas fa-bars"></i>
    </button>
    <a class="navbar-brand mr-1" href="{{ Route('desktop') }}" id="nombre_empresa">{{ session('userInfo.empresa') }}</a>
    <ul class="navbar-nav ml-auto">
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

  <!-- WRAPPER -->
  <div id="wrapper">
    @include('layouts._sidebar')

    <div  id="content-wrapper" class="d-flex flex-column p-0 m-0">
      <div id="content" style="padding:0 0 40px 0;">
        @yield('desktop-content')
      </div>

      <!-- Sticky Footer -->
      <footer class="sticky-footer bg-gray">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Pedro Altamirano 2019</span>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- endwrapper -->

  <!-- floating action button -->
  <x-fab></x-fab>

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
					<form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-primary"  type="submit"> Salir </button>
					</form>
        </div>
      </div>
    </div>
  </div>

  <!-- Password confirm Modal-->
  <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirma tu contraseña</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="#" id="confirmForm" method="POST">
          @csrf
          <div class="modal-body">
          <div class="container">
              <div class="form-group">
                <label for="password" class="form-label">Contraseña</label>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" id="password" required>
                </div>
              </div>
          </div>
          </div>
          <div class="modal-footer">
            <button class="btn bg-light" type="button" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-primary confirm-form" type="submit">Continuar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  @yield('modals')

  <!-- JavaScript -->
  <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/desktop.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/helpers.js') }}" type="text/javascript"></script>
  <script src="//cdn.datatables.net/plug-ins/1.10.22/api/sum().js" type="text/javascript"></script>
  <script src="{{ asset('js/printable.js') }}" type="text/javascript"></script>

  {{-- SWEET ALERT --}}
  @include('sweetalert::alert')
  @include('layouts.errors')

  @yield('scripts')
  @yield('after.scripts')

</body>
</html>
