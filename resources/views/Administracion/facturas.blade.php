@extends('layouts.app')

@section('links')
@endsection

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Facturación',
      'current' => true,
      'href' => route('facturacion'),
    ]
  ]"
/>

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
      <option value="1">Ingreso</option>
      <option value="0">Egreso</option>
    </select>
  </div>
  <div class="col-6 col-md form-group">
    <label for="estado">Estado</label>
    <select name="estado" id="estado" class="form-control form-control-sm refresh">
      <option value="none" selected>Todo</option>
      <option value="1">Pendiente</option>
      <option value="0">Pagado</option>
    </select>
  </div>
</x-filters>

<x-blue-board
  title='Facturas'
  :foot="[
    ['text'=>'Nueva', 'href'=>route('factura.create'), 'id'=>'nuevo', 'tipo'=> 'link']
  ]"
>
  <table id="table" class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Número</th>
        <th scope="col">Emición</th>
        <th scope="col">Mora</th>
        <th scope="col">Cliente</th>
        <th scope="col">Ing./Eg.</th>
        <th scope="col">Valor</th>
        <th scope="col" class="w-5">Crud</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="5" class="text-right">Total $</td>
        <td class="text-right" id="clmtotal"></td>
        <td class="w-5"></td>
      </tr>
    </tfoot>
  </table>
</x-blue-board>
@endsection

@section('scripts')
<script>
  var table = $('#table').DataTable({
    "paging":   true,
    "ordering": true,
    "info":     false,
    "responsive": true,
    "ajax": {
      "url": "{{ route('getFacturacion') }}",
      "method": 'get',
      "data": {
        "fechaini": function() { return $('#inicio').val() },
        "fechafin": function() { return $('#fin').val() },
        "cliente": function() { return $('#cliente').val() },
        "empresa": function() { return $('#empresa').val() },
        "tipo": function() { return $('#tipo').val() },
        "estado": function() { return $('#estado').val() }
      },
      "error": function(reason) {
        swal('Oops!', 'Ha ocurrido un error al cargar los datos!', 'error');
        console.log(reason);
      }
    },
    "columns": [
      {"name":"numero", "data":"numero"},
      {"name":"emision", "data":"emision"},
      {"name":"mora", "data":"mora"},
      {"name":"cliente", "data":"cli"},
      {"name":"tipo", "data":"tipo",
        "render":function(data, type, full, meta){
        return data ? 'Ingreso' : 'Egreso';
      }},
      {"name":"valor", "data":"total_pagar"},
      {"name":"crud", "data":"id", "sortable": "false",
        "render": function ( data, type, full, meta ) {
          return "<a class='fa fa-edit' href='factura/modificar/"+data+"'></a> <a class='fa fa-print' href='#'></a>";
        }
      }
    ],
    "columnDefs": [
      { targets: [5], className: 'text-right'},
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
      var totTotal = api.column('valor:name', {search: 'applied'}).data().sum();

      // Update footer
      $("#clmtotal").html(totTotal.toFixed(2));
    }
  });

  $('.refresh').on('change', function(){
    table.ajax.reload(null, false);
  });
</script>
@endsection
