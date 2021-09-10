@extends('layouts.app')

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
    ['text'=>'Nuevo', 'href'=>route('usuario.nuevo'), 'id'=>'nuevo', 'tipo'=>'link']
  ]"
>

  <table id="table" class="table table-striped table-sm">
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
  let routeAjax = `{{ route('usuarios.get') }}`;
  let routeEdit = `{{ route('usuarios.modificar', 0) }}`;
  $('#table').DataTable({
    "paging":   true,
    "ordering": true,
    "info":     false,
    "responsive": true,
    "ajax": {
      "url": routeAjax,
      "method": 'get',
      "error": error => {
        swal('Oops!', 'Ha ocurrido un error al cargar los datos!', 'error');
        console.log(error);
      }
    },
    "columns": [
      {"name":"nombre", "data": "nombre"},
      {"name":"apellido", "data": "apellido" },
      {"name":"perfil", "data": "perfil"},
      {"name":"crud", "data": "cedula", "sortable": "false",
        "render": (data, type, full, meta) => {
          let path = routeEdit.replace('/0', `/${data}`);
          return `<a class='fa fa-edit' href='${path}'></a>`;
        }
      }
    ],
    "columnDefs": [
    ],
    "rowCallback": function(row, data, index){
      (data.status == 1) ?
        $('td:eq(-1)', row).children('a').addClass('text-success') :
        $('td:eq(-1)', row).children('a').addClass('text-danger');
    },
  });
</script>
@endsection
