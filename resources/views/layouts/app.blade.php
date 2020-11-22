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
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
  
  @yield('links')
</head>

<body class="sidebar-toggled">
  
  <nav class="navbar navbar-expand navbar-dark bg-primary d-flex justify-content-lg-between sticky-top shadow">
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

  <div id="wrapper">
    @include('layouts._sidebar')
    
    <!-- WRAPPER -->
    <div  id="content-wrapper" class="d-flex flex-column p-0 m-0">
      <div id="content" style="padding:0 0 40px 0;">
        {{-- <div class="m-2 m-md-3 p-0">
          @json(session()->all())
        </div> --}}
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

  <!-- STATUS MODAL -->
  <x-status />
  <!-- ERRORS ALERT -->
  <x-errors />

  @yield('modals')

  <!-- JavaScript -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/helpers.js') }}"></script>

  @yield('scripts')
  @yield('after.scripts')

  <script>
    $('.modal-status').modal('show');

    @if($errors->any())
    $(".alert").fadeTo(10000, 0.5).slideUp(8000);
    @endif

    @yield('document.ready')
    @yield('after.document.ready')
  </script>

</body>

</html>
