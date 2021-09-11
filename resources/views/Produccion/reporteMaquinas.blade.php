@extends('layouts.app')

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Pedidos',
      'current' => false,
      'href' => route('pedidos'),
    ],
    [
      'text' => 'Reporte de maquinas',
      'current' => true,
      'href' => '#',
    ]
  ]"
></x-path>

<x-filters :clientes="[]" cli=0 />

<x-blue-board
  title='Reporte'
  :foot="[
    ['text'=>'fas fa-print', 'href'=>'#', 'id'=>'print', 'tipo'=>'button', 'print-target'=>'table'],
  ]"
>
  <table id="table" class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Cliente</th>
        <th scope="col">Detalle</th>
        @foreach ($procesos as $proceso)
        <th scope="col">{{$proceso->proceso}}</th>
        @endforeach
        <th scope="col">Total $</th>
        <th scope="col" class="w-5"></th>
        <th scope="col" class="w-5">Crud</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="3" class="text-right">Total $</td>
        @foreach ($procesos as $proceso)
        <th scope="col" id="{{'serv'.$proceso->id}}"></th>
        @endforeach
        <td id="clmtotal"></td>
        <td colspan="2"></td>
      </tr>
    </tfoot>
  </table>
</x-blue-board>
@endsection

@section('modals')
<div id="modalPedidoDiv"></div>
@endsection

@section('scripts')
<script>
  // let procesos = @json($procesos);
  // console.log(areas.length);

  const route = `{{ route('pedido.edit', 0) }}`;
  const routeAjax = `{{ route('reporte.maquinas.ajax') }}`;
  var table = $('#table').DataTable({
    "paging":   true,
    "ordering": true,
    "info":     false,
    "responsive": true,
    "ajax": {
      "url": routeAjax,
      "method": 'get',
      "dataSrc": '',
      "data": {
        "fechaini": () => $('#inicio').val(),
        "fechafin": () => $('#fin').val(),
        "cobro": () => $('#cobro').val(),
      },
      // "success": data => {
      //   console.log(data);
      // },
      "error": error => {
        swal('Oops!', 'Ha ocurrido un error al cargar los datos!', 'error');
        console.log(error);
      }
    },
    "columns": [
      {"name":"numero", "data": "numero"},
      {"name":"cliente", "data": "cliente_nom"},
      {"name":"detalle", "data": "detalle"},
      @foreach($procesos as $proceso)
      {"name":`{{ 'serv'.$proceso->id }}`, "data":"procesos", "defaultContent": "", "render": (data, type, full, meta) => {
        let proceso = data.find(record => record.proceso_id == `{{ $proceso->id }}`);
        return proceso ? proceso.totalProceso : '';
      }},
      @endforeach
      {"name":"total", "data": "total_pedido"},
      {"name":"estado", "data": "estado", "sortable": "false",
        "render": ( data, type, full, meta ) => {
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
        "render": (data, type, full, meta) => {
          let router = route.replace('/0', `/${data}`);
          let crud = `<a class='fa fa-edit' href='${router}'></a>`;
          crud += `<a class='fa fa-eye' href='#modalPedido' data-modaldata='${data}'></a>`;
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
      var intVal = i => {
        return typeof i === 'string' ?
        i.replace(/[\$,]/g, '')*1 :
        typeof i === 'number' ?
        i : 0;
      };

      // Total over this page
      var totTotal = api.column('total:name', {search: 'applied'}).data().sum();
      // Update footer
      $("#clmtotal").html(totTotal.toFixed(4));

      @foreach($procesos as $proceso)
      let {{"dataserv".$proceso->id}} = api.column(`{{"serv".$proceso->id}}:name`, {search: 'applied'}).cache('search');
      let {{"totserv".$proceso->id}} = {{'dataserv'.$proceso->id}}.length ? {{'dataserv'.$proceso->id}}.sum() : 0;
      $(`#{{'serv'.$proceso->id}}`).html({{'totserv'.$proceso->id}}.toFixed(4));
      @endforeach
    }
  });

  $('.refresh').change(() => table.ajax.reload(null, false));
</script>
@endsection
