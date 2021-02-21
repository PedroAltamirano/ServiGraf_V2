@extends('layouts.app')

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Libro Diario',
      'current' => true,
      'href' => '#',
    ]
  ]"
/>
<x-filters :clientes="[]" cli=0 cob=0>
  <div class="col-12 col-md form-group">
    <label for="cliente">Usuarios</label>
    <select name="usuario" id="usuario" class="form-control form-control-sm">
      <option value="none" selected>Selecciona uno...</option>
      @foreach ($usuarios as $user)
      <option value="{{ $user->cedula }}" {{ Auth::id() == $user->cedula ? 'selected' : '' }}>{{ $user->usuario }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-12 col-md form-group">
    <label for="cliente">Libros</label>
    <select name="libro" id="libro" class="form-control form-control-sm refresh">
      <option value="none" selected>Selecciona uno...</option>
    </select>
  </div>
</x-filters>

<x-blueBoard
  title='Flujo de activos'
  :foot="[
    ['text'=>'Nueva Entrada', 'href'=>'#', 'id'=>'modal-entrada', 'tipo'=> 'modal'],
    ['text'=>'Nuevo Libro', 'href'=>'#', 'id'=>'modal-libro', 'tipo'=> 'modal'],
    ['text'=>'Referencias y Bancos', 'href'=>'#', 'id'=>'referencias_bancos', 'tipo'=> 'link']
  ]"
>
  <table id="table" class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">Fecha</th>
        <th scope="col">Referencia</th>
        <th scope="col">Beneficiario</th>
        <th scope="col">Descripción</th>
        <th scope="col">Ingreso $</th>
        <th scope="col">Egreso $</th>
        <th scope="col">Saldo $</th>
        <th scope="col" class="crudCol">Crud</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="3"></td>
        <td class="text-right">Total $</td>
        <td id="total-ingreso"></td>
        <td id="total-egreso"></td>
        <td id="total-saldo"></td>
        <th scope="col" class="crudCol"></th>
      </tr>
    </tfoot>
  </table>
</x-blueBoard>

@include('Administracion.libro-entrada')

@endsection

@section('scripts')
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function getLibros(){
    $.ajax({
      url:"{{ route('libro.api.libros') }}",
      type: 'post',
      dataType: "json",
      data: {
        'usuario': $('#usuario').val(),
      },
      success: function(data) {
        let content;
        $.each(data, (index, value)=>{
          content += '<option value="'+value.id+'">'+value.libro+'</option>';
        });
        $('#libro').empty().append(content);
        table.ajax.reload(null, false);
      },
      error: function(jqXhr, textStatus, errorThrown){
        console.log(errorThrown);
      }
    });
  }

  $(()=>{
    getLibros();
  })

  $('#usuario').change(()=>{
    alert('change')
    getLibros();
  })

  var saldo = 0;
  var dato_fecha = '';
  var dato_color = '';
  var cambio_color = false;
  var table = $('#table').DataTable({
    "paging":   true,
    "ordering": true,
    "info":     false,
    "responsive": true,
    "buttons": [{
      extend: 'print',
      text: 'Imprimir Libro Diario',
      autoPrint: false
    }],
    "ajax": {
      "url": "{{route('libro.api.info')}}",
      "method": 'post',
      "dataSrc": '',
      "data": {
        "fechaini": function() { return $('#inicio').val() },
        "fechafin": function() { return $('#fin').val() },
        "usuario": function() { return $('#usuario').val() },
        "libro": function() { return $('#libro').val() }
      },
      // "success": function(data){
      //   debugger
      // },
      "error": function(reason) {
        alert('Ha ocurrido un error al cargar los datos!');
        console.log('error -> ');
        console.log(reason);
      }
    },
    "columns": [
      {"name":"fecha", "data": "fecha"},
      {"name":"referencia", "data": "referencia"},
      {"name":"beneficiario", "data": "beneficiario"},
      {"name":"detalle", "data": "detalle"},
      {"name":"ingreso", "data": "ingreso", "class": "text-right"},
      {"name":"egreso", "data": "egreso", "class": "text-right"},
      {"name":"saldo", "defaultContent": "0.00", "class": "text-right bold"},
      {"name":"crud", "data":null, "sortable": "false",
        "render": function ( data, type, full, meta ) {
          data = JSON.stringify(data);
          return "<a class='fa fa-edit modalEntrada' href='#modalEntrada' data-toggle='modal' data-entrada='"+data+"' ></a> <a class='fa fa-print'  href='#modalRecivo' data-toggle='modal'></a>"
        }
      }
    ],
    "columnDefs": [
      { "responsivePriority": 1, "targets": [0, 2, 4, 5] }
    ],
    "rowCallback": function ( row, data, index ){
      // cabio de olor por fecha
      let fecha = data.fecha;
      let dato_color;

      if (dato_fecha != fecha) {
        dato_fecha = fecha;
        cambio_color = !cambio_color;
      }
      dato_color = (cambio_color) ? '#6E85B1' : '#69A9C3';
      $(row).css({'color':''+dato_color +''});

      // sumas de saldo
      let debe = parseFloat(data.ingreso);
      let haber = parseFloat(data.egreso);
      saldo += debe;
      saldo -= haber;

      let texto = (saldo < 0) ? '<font color="red">'+Math.abs(saldo).toFixed(2)+'</font>' : saldo.toFixed(2);

      $('td:eq(6)', row).html(texto);
    },
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
      let ingTotal = api.column('ingreso:name', {search: 'applied'}).data().reduce(function (a, b){
        return intVal(a) + intVal(b);
      }, 0);
      let egrTotal = api.column('egreso:name', {search: 'applied'}).data().reduce(function (a, b){
        return intVal(a) + intVal(b);
      }, 0);
      let saldo = Math.abs(ingTotal) - Math.abs(egrTotal);

      // Update footer
      $("#total-ingreso").html(ingTotal.toFixed(2));
      $("#total-egreso").html(egrTotal.toFixed(2));
      if(ingTotal < egrTotal){
        $("#total-saldo").css({'color': "red"});
      }
      $("#total-saldo").html(Math.abs(saldo).toFixed(2));
    },
    "drawCallback": function ( settings ) {
      saldo = 0;
    }
  });

  $('.refresh').on('change', function(){
    saldo = 0;
    dato_fecha = '';
    dato_color = '';
    cambio_color = false;
    table.ajax.reload(null, false);
  });
</script>
<script>
  $('.modalEntrada').on('click', function () {
    debugger
    var button = $(this);
    var modal = $('#modalEntrada');
    modal.find('.modal-title').html('Modificar Entrada');
  });
</script>
@endsection
