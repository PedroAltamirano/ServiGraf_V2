@extends('layouts.app')

@section('desktop-content')
  <x-path :items="[ ['text' => 'Facturación', 'current' => true, 'href' => route('facturacion')] ]" />

  <x-filters :clientes="$clientes" cob=0>
    <div class="col-6 col-md form-group">
      <label for="empresa">Empresa</label>
      <select name="empresa" id="empresa" class="form-control form-control-sm refresh">
        @foreach ($empresas as $item)
          <option value="{{ $item->id }}">{{ $item->empresa }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-6 col-md form-group">
      <label for="tipo">Tipo</label>
      <select name="tipo" id="tipo" class="form-control form-control-sm refresh">
        <option value="none" selected>Todo</option>
        @foreach (config('factura.tipo') as $key => $val)
          <option value="{{ $key }}">{{ $val }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-6 col-md form-group">
      <label for="estado">Estado</label>
      <select name="estado" id="estado" class="form-control form-control-sm refresh">
        <option value="none" selected>Todo</option>
        @foreach (config('factura.estado') as $key => $val)
          <option value="{{ $key }}">{{ $val }}</option>
        @endforeach
      </select>
    </div>
  </x-filters>

  <x-blue-board title='Facturas'
    :foot="[ ['text'=>'Nueva', 'href'=>route('factura.create'), 'id'=>'nuevo', 'tipo'=>'link'] ]">
    <table id="table" class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col" class="w-10">Número</th>
          <th scope="col" class="w-10">Emición</th>
          <th scope="col" class="w-10">Mora</th>
          <th scope="col">Cliente</th>
          <th scope="col" class="w-10">Ing./Eg.</th>
          <th scope="col" class="w-10">Valor</th>
          <th scope="col" class="w-2">Crud</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="5" class="text-right">Total $</td>
          <td class="text-right" id="clmtotal"></td>
          <td class="w-2"></td>
        </tr>
      </tfoot>
    </table>
  </x-blue-board>
@endsection

@section('scripts')
  <script>
    const routeAjax = `{{ route('getFacturacion') }}`;
    const routeEdit = `{{ route('factura.edit', 0) }}`;
    const routePrint = `{{ route('factura.print', 0) }}`;
    var table = $('#table').DataTable({
      "paging": true,
      "ordering": true,
      "info": false,
      "responsive": true,
      "ajax": {
        "url": routeAjax,
        "method": 'get',
        "data": {
          "fechaini": () => $('#inicio').val(),
          "fechafin": () => $('#fin').val(),
          "cliente": () => $('#cliente').val(),
          "empresa": () => $('#empresa').val(),
          "tipo": () => $('#tipo').val(),
          "estado": () => $('#estado').val(),
        },
        "error": error => {
          swal('Oops!', 'Ha ocurrido un error al cargar los datos!', 'error');
          console.log(error);
        }
      },
      "columns": [{
          "name": "numero",
          "data": "numero"
        },
        {
          "name": "emision",
          "data": "emision"
        },
        {
          "name": "mora",
          "data": "mora"
        },
        {
          "name": "cliente",
          "data": "cli"
        },
        {
          "name": "tipo",
          "data": "tipo",
          "render": (data, type, full, meta) => {
            return data ? 'Ingreso' : 'Egreso';
          }
        },
        {
          "name": "valor",
          "data": "total_pagar"
        },
        {
          "name": "crud",
          "data": "id",
          "sortable": "false",
          "render": (data, type, full, meta) => {
            let route = routeEdit.replace('/0', `/${data}`);
            let print_route = routePrint.replace('/0', `/${data}`);
            let crud = `<a class='fa fa-edit' href='${route}'></a>`;
            crud += `<a class='fa fa-print' href='${print_route}' target='_blank'></a>`;
            return crud;
          }
        }
      ],
      "columnDefs": [{
        targets: [5],
        className: 'text-right'
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
        var totTotal = api.column('valor:name', {
          search: 'applied'
        }).data().sum();

        // Update footer
        $("#clmtotal").html(totTotal.toFixed(4));
      }
    });

    $('.refresh').change(() => table.ajax.reload(null, false));
  </script>
@endsection
