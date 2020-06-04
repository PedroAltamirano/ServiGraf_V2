@extends('layouts.app')

@section('links')
@endsection

@section('desktop-content')
<path-route
  :items="[
    {
      text: 'Pedidos',
      current: true,
      href: '#',
    }
  ]"
></path-route>

<blue-board
  title='Pendientes'
  :foot="[
    {text:'Nuevo', href:'pedido/nuevo', tipo: 'link'},
  ]"
>
  <table id="table" class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">Numero</th>
        <th scope="col">Cliente</th>
        <th scope="col">Detalle</th>
        <th scope="col">Cant</th>
        <th scope="col">Procesos</th>
        <th scope="col" class="crudCol">Crud</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    </tfoot>
  </table> 
</blue-board>
@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    $('#table').DataTable({
      "paging":   true,
      "ordering": true,
      "info":     false,
      "ajax": {
        "url": "{{url('/pedidos/get')}}",
        "method": 'get',
        "error": function(reason) {
          alert('Ha ocurrido un error al cargar los datos!');
          console.log('error -> ');
          console.log(reason);
        }
      },
      "columns": [
        {"name":"numero", "data":"numero"},
        {"name":"cliente", "data":"cliente"},
        {"name":"detalle", "data":"detalle", "sortable": "false"},
        {"name":"cantidad", "data":"cantidad", "sortable": "false"},
        {"name":"servicios", "data":"servicios[, ]", "sortable": "false"},
        {"name":"crud", "data":"numero", "sortable": "false",
          "render": function ( data, type, full, meta ) {
            return "<a class='fa fa-edit' href='ot/modificar/"+data+"'></a> <a class='fa fa-eye' href='#' onClick='openOt("+data+")'></a>"
          }
        }
      ],
      "columnDefs": [
        { "responsivePriority": 1, "targets": [0, 1, -1] }
      ],
      responsive: true,
    });
  });
</script>
@endsection