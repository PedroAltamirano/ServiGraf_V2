@extends('layouts.app')

@section('links')
@endsection

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Usuarios',
      'current' => true,
      'href' => route('usuarios'),
    ]
  ]"
/>

<x-blue-board
  title='Listado'
  :foot="[
    ['text'=>'Nuevo', 'href'=>route('usuario.nuevo'), 'id'=>'nuevo', 'tipo'=> 'link']
  ]"
>

  <table id="table" class="table table-responsive table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Perfil</th>
        <th scope="col" class="w-5">Crud</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    </tfoot>
  </table>
</x-blue-board>
@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    $('#table').DataTable({
      "paging":   true,
      "ordering": true,
      "info":     false,
      "responsive": true,
      "ajax": {
        "url": "{{url('/usuarios/get')}}",
        "method": 'get',
        "error": function(reason) {
          swal('Oops!', 'Ha ocurrido un error al cargar los datos!', 'error');
          console.log('error -> ', reason);
        }
      },
      "columns": [
        {"name":"nombre", "data": "nombre"},
        {"name":"apellido", "data": "apellido" },
        {"name":"perfil", "data": "perfil"},
        {"name":"crud", "data": "cedula",
          "render": function ( data, type, full, meta ) {
            return "<a class='fa fa-edit' href='usuario/modificar/"+data+"'></a>"
          }, "sortable": "false"
        }
      ],
      "columnDefs": [
      ],
      "rowCallback": function(row, data, index){
        (data.status == 1) ? $('td:eq(-1)', row).children('a').addClass('text-success') : $('td:eq(-1)', row).children('a').addClass('text-danger');
      },
    });
  });
</script>
@endsection
