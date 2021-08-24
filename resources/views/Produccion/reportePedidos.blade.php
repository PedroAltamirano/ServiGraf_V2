@extends('layouts.app')

@section('links')
@endsection

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Pedidos',
      'current' => false,
      'href' => route('pedidos'),
    ],
    [
      'text' => 'Reporte de pedidos',
      'current' => true,
      'href' => '#',
    ]
  ]"
></x-path>

<x-filters :clientes="$clientes" />

<x-blueBoard
  title='Reporte'
  :foot="[
    ['text'=>'fas fa-print', 'href'=>'', 'id'=>'print', 'tipo'=>'button', 'print-target'=>'table'],
  ]"
>
  <table id="table" class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Cliente</th>
        <th scope="col">Detalle</th>
        @foreach ($areas as $area)
        <th scope="col">{{$area->area}}</th>
        @endforeach
        <th scope="col">Total $</th>
        <th scope="col">Abonos $</th>
        <th scope="col">Saldo $</th>
        <th scope="col" class="crudCol"></th>
        <th scope="col" class="crudCol">Crud</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <tr>
        @php
            $count = count($areas ?? []) + 3;
        @endphp
        <td colspan="{{$count}}" class="text-right">Total $</td>
        <td id="clmtotal"></td>
        <td id="clmabonos"></td>
        <td id="clmsaldo"></td>
        <td colspan="2"></td>
      </tr>
    </tfoot>
  </table>
</x-blueBoard>

<div id="modalPedidoDiv"></div>
@endsection

@section('scripts')
<script>
  // let areas = @json($areas);
  // console.log(areas.length);

  const route = "{{ route('pedido.edit', 0) }}";
  var table = $('#table').DataTable({
    "paging":   true,
    "ordering": true,
    "info":     false,
    "responsive": true,
    "ajax": {
      "url": "{{ route('reporte.pedidos.ajax') }}",
      "method": 'get',
      "dataSrc": '',
      "data": {
        "fechaini": function() { return $('#inicio').val() },
        "fechafin": function() { return $('#fin').val() },
        "cliente": function() { return $('#cliente').val() },
        "cobro": function() { return $('#cobro').val() }
      },
      // "success": function(data){
      //   console.log(data);
      // },
      "error": function(reason) {
        swal('Oops!', 'Ha ocurrido un error al cargar los datos!', 'error');
        console.log('error -> ', reason);
      }
    },
    "columns": [
      {"name":"numero", "data": "numero"},
      {"name":"cliente", "data": "cliente_nom"},
      {"name":"detalle", "data": "detalle"},
      @foreach($areas as $area)
      {"name":"{{$area->area}}", "data":"areas", "defaultContent": "", "render":function(data, type, full, meta){
        let area = data.find(record => record.area_id === '{{$area->id}}');
        return area ? area.totalArea : '';
      }},
      @endforeach
      {"name":"total", "data": "total_pedido"},
      {"name":"abonos", "data": "abono"},
      {"name":"saldo", "data": "saldo"},
      {"name":"estado", "data": "estado", "sortable": "false",
        "render": function ( data, type, full, meta ) {
          var rspt;
          if(data == '1') rspt = "<em class='fa fa-times'></em>";
          else if(data == '2') rspt = "<em class='fa fa-check'></em>";
          else if(data == '3') rspt = "<em class='fas fa-trash'></em>";
          else if(data == '4') rspt = "<em class='fas fa-exchange-alt'></em>";
          else rspt = "<em class='fa fa-ban'></em>";
          return rspt;
        },
      },
      {"name":"crud", "data":"id", "sortable": "false",
        "render": function ( data, type, full, meta ) {
          let router = route.replace("/0", "/"+data);
          let crud = "<a class='fa fa-edit' href='"+router+"'></a> ";
          crud += "<a class='fa fa-eye verPedido' href='#' data-pedido_id='"+data+"'></a>";
          return crud;
        }
      }
    ],
    "columnDefs": [
      { "responsivePriority": 1, "targets": [0, 1, -2, -3] }
    ],
    "footerCallback": function(row, data, start, end, display) {
      var api = this.api(), data;
      // Remove the formatting to get integer data for summation
      var intVal = function (i) {
        return typeof i === 'string' ?
        i.replace(/[\$,]/g, '')*1 :
        typeof i === 'number' ?
        i : 0;
      };

      // Total over this page
      var totTotal = api.column('total:name', {search: 'applied'}).data().sum();
      var aboTotal = api.column('abonos:name', {search: 'applied'}).data().sum();
      var salTotal = api.column('saldo:name', {search: 'applied'}).data().sum();

      // Update footer
      $("#clmtotal").html(totTotal.toFixed(2));
      $("#clmabonos").html(aboTotal.toFixed(2));
      $("#clmsaldo").html(salTotal.toFixed(2));
    }
  });

  $('.refresh').on('change', function(){
    table.ajax.reload(null, false);
  });
</script>
@endsection
