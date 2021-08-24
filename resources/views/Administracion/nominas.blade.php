@extends('layouts.app')

@section('links')
@endsection

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Nominas',
      'current' => true,
      'href' => '#',
    ]
  ]"
/>

<x-blueBoard
  title='Nominas'
  :foot="[
    ['text'=>'Nuevo', 'href'=>route('nomina.create'), 'id'=>'nuevo', 'tipo'=> 'link']
  ]"
>
  <table id="table" class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Cédula</th>
        <th scope="col">Nombre</th>
        <th scope="col">Telefono</th>
        <th scope="col">Correo</th>
        <th scope="col">Cargo</th>
        <th scope="col">Valor</th>
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
        console.log('error -> ', reason);
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
