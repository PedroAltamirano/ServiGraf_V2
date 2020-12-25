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
      <option>Todo</option>
      <option value="1">Ingreso</option>
      <option value="0">Egreso</option>
    </select>
  </div>
  <div class="col-6 col-md form-group">
    <label for="estado">Estado</label>
    <select name="estado" id="estado" class="form-control form-control-sm refresh">
      <option>Todo</option>
      <option value="1">Pendiente</option>
      <option value="0">Pagado</option>
    </select>
  </div>
</x-filters>

<x-blueBoard
  title='Facturas'
  :foot="[
    ['text'=>'Nuevo', 'href'=>route('factura.create'), 'id'=>'nuevo', 'tipo'=> 'link']
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
        <th scope="col" class="text-right">Valor</th>
        <th scope="col" class="crudCol">Crud</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="5" class="text-right">Total $</td>
        <td class="text-right" id="clmtotal"></td>
        <td class="crudCol"></td>
      </tr>
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
        "url": "{{url('getFacturas')}}",
        "method": 'get',
        "data": {
        "fechaini": function() { return $('#inicio').val() },
        "fechafin": function() { return $('#fin').val() },
        "cliente": function() { return $('#cliente').val() },
        "empresa": function() { return $('#empresa').val() }
        "tipo": function() { return $('#tipo').val() }
        "estado": function() { return $('#estado').val() }
      },
        "error": function(reason) {
          alert('Ha ocurrido un error al cargar los datos!');
        }
      },
      "columns": [
        {"name":"numero", "data":"numero"},
        {"name":"emision", "data":"emision"},
        {"name":"mora", "data":"mora"},
        {"name":"cliente", "data":"cliente"},
        {"name":"tipo", "data":"tipo"},
        {"name":"valor", "data":"valor"},
        {"name":"crud", "data":"id", "sortable": "false",
          "render": function ( data, type, full, meta ) {
            return "<a class='fa fa-edit' href='factura/modificar/"+data+"'></a><a class='fa fa-print' href='#'></a>";
          }
        }
      ],
      "columnDefs": [
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
  });
</script>
@endsection
