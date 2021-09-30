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

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

  @yield('links')
</head>

<body class="sidebar-toggled">
  @include('layouts.errors')


  @include('layouts._header')

  <div id="wrapper">
    {{-- @include('layouts._sidebar') --}}
    <x-sidebar />

    <div id="content-wrapper" class="d-flex flex-column p-0 m-0">
      <main id="content" style="padding:0 0 40px 0;">
        @yield('desktop-content')
      </main>

      @include('layouts._footer')
    </div>
  </div>

  <x-fab />

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
            <button class="btn btn-primary" type="submit"> Salir </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <x-confirm-modal />
  <x-delete-modal />

  @yield('modals')

  <!-- JavaScript -->
  <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/helpers.js') }}" type="text/javascript"></script>
  <script src="//cdn.datatables.net/plug-ins/1.10.22/api/sum().js" type="text/javascript"></script>
  <script src="{{ asset('js/printable.js') }}" type="text/javascript"></script>

  {{-- SWEET ALERT --}}
  @include('sweetalert::alert')

  @yield('scripts')
  @yield('after.scripts')
  @stack('component-script')

</body>

</html>
