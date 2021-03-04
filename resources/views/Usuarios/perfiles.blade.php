@extends('layouts.app')

@section('links')
@endsection

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Perfiles',
      'current' => true,
      'href' => route('perfiles'),
    ]
  ]"
/>

<x-blueBoard
  title='Listado'
  :foot="[
    ['text'=>'Nuevo', 'href'=>route('perfil.nuevo'), 'id'=>'nuevo', 'tipo'=> 'link']
  ]"
>

  <table id="table" class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Descripción</th>
        <th scope="col" class="crudCol">Crud</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    </tfoot>
  </table>
</x-blueBoard>
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
        "url": "{{url('/perfiles/get')}}",
        "method": 'get',
        "error": function(reason) {
          alert('Ha ocurrido un error al cargar los datos!');
        }
      },
      "columns": [
        {"name":"nombre", "data":"nombre"},
        {"name":"descripcion", "data":"descripcion", "sortable":"false"},
        {"name":"crud", "data":"id", "sortable":"false",
          "render": function ( data, type, full, meta ) {
            return "<a class='fa fa-edit' href='perfil/modificar/"+data+"'></a>";
          }
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
