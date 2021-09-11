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

<x-blue-board
  title='Flujo de activos'
  :foot="[
    ['text'=>'Nueva Entrada', 'href'=>route('entrada.create'), 'id'=>'newEntrada', 'tipo'=>'link'],
    ['text'=>'Nuevo Libro', 'href'=>'#modalLibro', 'id'=>'modal-libro', 'tipo'=>'modal'],
    ['text'=>'Referencias y Bancos', 'href'=>route('referencias-bancos'), 'id'=>'referencias_bancos', 'tipo'=>'link']
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
        <th scope="col" class="w-5">Crud</th>
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
        <th scope="col" class="w-5"></th>
      </tr>
    </tfoot>
  </table>
</x-blue-board>
@endsection

@section('modals')
@include('Administracion.modal-recibo')
@endsection

@section('scripts')
<script src="{{ asset('js/num2word.js') }}" type="text/javascript"></script>
<script>
  const routeLibros = `{{ route('libro.api.libros') }}`;
  const getLibros = () => {
    axios.post(routeLibros, {
      usuario: $('#usuario_id').val(),
    }).then(res => {
      let data = res.data
      let content = '';
      data.forEach(value => {
        content += `<option value='${value.id}'>${value.libro}</option>`;
      });
      $('#libro').empty().append(content);
      table.ajax.reload(null, false);
    }).catch(error => {
      swal('Oops!', 'No hemos podido cargar los libros', 'error');
      console.log(error);
    });
  }

  $(() => getLibros());

  $('#usuario').change(() => getLibros());

  var saldo = 0;
  var dato_fecha = '';
  var dato_color = '';
  var cambio_color = false;
  const routeAjax = `{{route('libro.api.info')}}`;
  const routeEdit = `{{ route('entrada.edit', 0) }}`;
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
      "url": routeAjax,
      "method": 'post',
      "dataSrc": '',
      "data": {
        "fechaini": () => $('#inicio').val(),
        "fechafin": () => $('#fin').val(),
        "usuario": () => $('#usuario').val(),
        "libro": () => $('#libro').val(),
      },
      // "success": data => {
      //   debugger
      // },
      "error": error => {
        swal('Oops!', 'Ha ocurrido un error al cargar los datos!', 'error');
        console.log(error);
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
        "render": (data, type, full, meta) => {
          let dataJson = JSON.stringify(data);
          let router = routeEdit.replace("/0", `/${data.id}`);
          let crud = `<a class='fa fa-edit' href='${router}'></a>`;
          crud += `<a class='fa fa-print' href='#modalRecibo' data-toggle='modal' data-entrada='${dataJson}'></a>`;
          return crud;
        }
      }
    ],
    "columnDefs": [
      { "responsivePriority": 1, "targets": [0, 2, 4, 5] }
    ],
    "rowCallback": (row, data, index) => {
      // cabio de olor por fecha
      let fecha = data.fecha;
      let dato_color;

      if (dato_fecha != fecha) {
        dato_fecha = fecha;
        cambio_color = !cambio_color;
      }
      dato_color = (cambio_color) ? '#6E85B1' : '#69A9C3';
      $(row).css({'color': `${dato_color}`});

      // sumas de saldo
      let debe = parseFloat(data.ingreso);
      let haber = parseFloat(data.egreso);
      saldo += debe;
      saldo -= haber;

      let texto = (saldo < 0) ? '<font color="red">'+Math.abs(saldo).toFixed(2)+'</font>' : saldo.toFixed(2);

      $('td:eq(6)', row).html(texto);
    },
    "footerCallback": function(row, data, start, end, display){
      var api = this.api(), data;
      // Remove the formatting to get integer data for summation
      var intVal = i => {
        return typeof i === 'string' ?
        i.replace(/[\$,]/g, '')*1 :
        typeof i === 'number' ?
        i : 0;
      };

      // Total over this page
      let ingTotal = api.column('ingreso:name', {search: 'applied'}).data().reduce((a, b) => intVal(a) + intVal(b), 0);
      let egrTotal = api.column('egreso:name', {search: 'applied'}).data().reduce((a, b) => intVal(a) + intVal(b), 0);
      let saldo = Math.abs(ingTotal) - Math.abs(egrTotal);

      // Update footer
      $("#total-ingreso").html(ingTotal.toFixed(2));
      $("#total-egreso").html(egrTotal.toFixed(2));
      if(ingTotal < egrTotal) $("#total-saldo").css({'color': "red"});
      $("#total-saldo").html(Math.abs(saldo).toFixed(2));
    },
    "drawCallback": settings => saldo = 0
  });

  $('.refresh').change(() => {
    saldo = 0;
    dato_fecha = '';
    dato_color = '';
    cambio_color = false;
    table.ajax.reload(null, false);
  });

  $("#modalRecibo").on('show.bs.modal', event => {
    let data = $(event.relatedTarget).data('entrada');
    let tipo = data.tipo ? 'COBRO' : 'PAGO';
    let ciudad = `{{ Auth::user()->empresa->datos->ciudad ?? '' }}`;
    let fecha = ciudad + ', ' + data.fecha;
    let valor = data.tipo ? data.ingreso : data.egreso;
    let empresa = `{{ Auth::user()->empresa->nombre }}`;
    let valor_texto = numeroALetras(valor);
    $('.recibo-tipo').html(tipo);
    $('.recibo-fecha').html(fecha);
    $('.recibo-valor').html(valor);
    $('.recibo-empresa').html(empresa);
    $('.recibo-valor_texto').html(valor_texto);
    $('.recibo-detalle').html(data.detalle);
    $('.recibo-pago').html(data.banco);
    $('.recibo-beneficiario').html(data.beneficiario);
    $('.recibo-ci').html(data.ci);
  });
</script>
@endsection
