@extends('layouts.app')

@section('links')
@endsection

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Pedidos',
      'current' => true,
      'href' => route('pedidos'),
    ]
  ]"
/>

<x-blue-board
  title='Pendientes'
  :foot="[
    ['text'=>'Nuevo', 'href'=>route('pedido.create'), 'id'=>'nuevo', 'tipo'=> 'link'],
  ]"
>
  <table id="table" class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">Numero</th>
        <th scope="col">Cliente</th>
        <th scope="col" style="width: 25%">Detalle</th>
        <th scope="col">Cant</th>
        <th scope="col" style="width: 40%">Procesos</th>
        <th scope="col" class="w-5">Crud</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($pedidos as $item)
      <tr>
        <td>{{ $item->numero }}</td>
        <td>{{ $item->cliente->bussiness_name }}</td>
        <td>{{ $item->detalle }}</td>
        <td>{{ $item->cantidad }}</td>
        <td>{{ implode(', ', $item->procesos_incompletos_nombre) }}</td>
        <td><a class='fa fa-edit' href='{{route('pedido.edit', $item->numero)}}'></a> <a class='fa fa-eye verPedido' data-pedido_id="{{ $item->id }}" id="{{ $item->numero }}" href="#"></a></td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
    </tfoot>
  </table>
</x-blue-board>

<div id="modalPedidoDiv"></div>

@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    $('#table').DataTable({
      "info": false,
      "paging": true,
      "ordering": true,
      "responsive": true,
      // "ajax": {
      //   "url": "{{url('/pedidos/get')}}",
      //   "method": 'get',
      //   "error": function(reason) {
      //     alert('Ha ocurrido un error al cargar los datos!');
      //     console.log('error -> ');
      //     console.log(reason);
      //   }
      // },
      // "columns": [
      //   {"name":"numero", "data":"numero"},
      //   {"name":"cliente", "data":"cliente"},
      //   {"name":"detalle", "data":"detalle", "sortable": "false"},
      //   {"name":"cantidad", "data":"cantidad", "sortable": "false"},
      //   {"name":"procesos", "data":"procesos[, ]", "sortable": "false"},
      //   {"name":"crud", "data":"numero", "sortable": "false",
      //     "render": function ( data, type, full, meta ) {
      //       return "<a class='fa fa-edit' href='ot/modificar/"+data+"'></a> <a class='fa fa-eye' href='#' onClick='openOt("+data+")'></a>"
      //     }
      //   }
      // ],
      // "columnDefs": [
      //   { "responsivePriority": 1, "targets": [0, 1, -1] }
      // ],
    });
  });
</script>
@endsection
