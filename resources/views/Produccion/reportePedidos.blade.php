@extends('layouts.app')

@section('desktop-content')
  <x-path
    :items="[ ['text' => 'Pedidos', 'current' => false, 'href' => route('pedidos')], ['text' => 'Reporte de pedidos', 'current' => true, 'href' => '#'] ]">
  </x-path>

  <x-filters />

  <x-blue-board title='Reporte'
    :foot="[ ['text'=>'fas fa-print', 'href'=>'', 'id'=>'print', 'tipo'=>'button', 'print-target'=>'table'] ]">
    <table id="table" class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No.</th>
          <th scope="col">Cliente</th>
          <th scope="col">Detalle</th>
          @foreach ($areas as $area)
            <th scope="col">{{ $area->area }}</th>
          @endforeach
          <th scope="col">Cotizado $</th>
          <th scope="col">Total $</th>
          <th scope="col">Abonos $</th>
          <th scope="col">Saldo $</th>
          <th scope="col" class="w-2"></th>
          <th scope="col" class="w-2">Crud</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <tr>
          @php
            $count = count($areas ?? []) + 3;
          @endphp
          <td colspan="{{ $count }}" class="text-right">Total $</td>
          <td id="clmcotizado"></td>
          <td id="clmtotal"></td>
          <td id="clmabonos"></td>
          <td id="clmsaldo"></td>
          <td colspan="2"></td>
        </tr>
      </tfoot>
    </table>
  </x-blue-board>
@endsection

@section('modals')
  <x-modal-pedido />
@endsection

@section('scripts')
  <script>
    const areas = JSON.parse(`@json($areas)`);
    const start = [{
        "name": "numero",
        "data": "numero"
      },
      {
        "name": "cliente",
        "data": "cliente_nom"
      },
      {
        "name": "detalle",
        "data": "detalle"
      },
    ];
    areas.map(area => {
      start.push({
        "name": `${area.area}`,
        "data": "areas",
        "defaultContent": "",
        "render": (data, type, full, meta) => {
          let aread = data.find(record => record.area_id == `${area.id}`);
          return aread?.totalArea ?? '';
        }
      });
    });
    const final = [{
        "name": "cotizado",
        "data": "cotizado"
      },
      {
        "name": "total",
        "data": "total_pedido"
      },
      {
        "name": "abonos",
        "data": "abono"
      },
      {
        "name": "saldo",
        "data": "saldo"
      },
      {
        "name": "estado",
        "data": "estado",
        "sortable": "false",
        "render": (data, type, full, meta) => {
          var rspt;
          if (data == '1') rspt = "<em class='fa fa-times'></em>";
          else if (data == '2') rspt = "<em class='fa fa-check'></em>";
          else if (data == '3') rspt = "<em class='fas fa-trash'></em>";
          else if (data == '4') rspt = "<em class='fas fa-exchange-alt'></em>";
          else rspt = "<em class='fa fa-ban'></em>";
          return rspt;
        },
      },
      {
        "name": "crud",
        "data": "id",
        "sortable": "false",
        "render": (data, type, full, meta) => {
          let router = route.replace("/0", "/" + data);
          let crud =
            `<a class='fa fa-eye' href='#modalPedido' data-toggle='modal' data-modaldata='${data}'></a> `;
          crud += `<a class='fa fa-edit' href='${router}'></a>`;
          return crud;
        }
      }
    ];
    const columns = [...start, ...final];

    const route = `{{ route('pedido.edit', 0) }}`;
    const routeAjax = `{{ route('reporte.pedidos.ajax') }}`;
    var table = $('#table').DataTable({
      "paging": true,
      "ordering": true,
      "info": false,
      "responsive": true,
      "ajax": {
        "url": routeAjax,
        "method": 'get',
        "dataSrc": '',
        "data": {
          "fechaini": () => $('#inicio').val(),
          "fechafin": () => $('#fin').val(),
          "cliente": () => $('#cliente').val(),
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
      "columns": columns,
      "columnDefs": [{
        "responsivePriority": 1,
        "targets": [0, 1, -2, -3]
      }],
      "footerCallback": function(row, data, start, end, display) {
        var api = this.api(),
          data;
        // Remove the formatting to get integer data for summation
        var intVal = i => {
          return typeof i === 'string' ?
            i.replace(/[\$,]/g, '') * 1 :
            typeof i === 'number' ?
            i : 0;
        };

        // Total over this page
        var cotizadoTotal = api.column('cotizado:name', {
          search: 'applied'
        }).data().sum();
        var totTotal = api.column('total:name', {
          search: 'applied'
        }).data().sum();
        var aboTotal = api.column('abonos:name', {
          search: 'applied'
        }).data().sum();
        var salTotal = api.column('saldo:name', {
          search: 'applied'
        }).data().sum();

        // Update footer
        $("#clmcotizado").html(cotizadoTotal.toFixed(4));
        $("#clmtotal").html(totTotal.toFixed(4));
        $("#clmabonos").html(aboTotal.toFixed(4));
        $("#clmsaldo").html(salTotal.toFixed(4));
      }
    });

    $('.refresh').change(() => table.ajax.reload(null, false));
  </script>
@endsection
