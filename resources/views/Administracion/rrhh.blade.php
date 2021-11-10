@extends('layouts.app')

@section('desktop-content')
  <x-path :items="[ ['text' => 'RRHH', 'current' => true, 'href' => '#'] ]" />
  <x-filters cli=0 cob=0>
    <div class="col-12 col-md form-group">
      <label for="cliente">Usuarios</label>
      <select name="usuario" id="usuario" class="form-control form-control-sm refresh">
        <option value="none" selected>Selecciona uno...</option>
        @foreach ($usuarios as $user)
          <option value="{{ $user->cedula }}">{{ $user->usuario }}</option>
        @endforeach
      </select>
    </div>
  </x-filters>

  <x-blue-board title='Asistencia'
    :foot="[ ['text' => 'Hoy', 'href' => '#', 'id' => 'hoy', 'tipo' => 'link'], ['text' => 'Semana', 'href' => '#', 'id' => 'semana', 'tipo' => 'link'], ['text' => 'Mes', 'href' => '#', 'id' => 'mes', 'tipo' => 'link'], ['text' => 'Horarios', 'href' => route('horarios'), 'id' => 'horarios', 'tipo' => 'link'], ['text' => 'fas fa-print', 'href' => '#', 'id' => 'mes', 'tipo' => 'button', 'print-target' => 'table'] ]">
    <table id="table" class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Fecha</th>
          <th scope="col">Entrada</th>
          <th scope="col">Salida</th>
          <th scope="col">Entrada</th>
          <th scope="col">Salida</th>
          <th scope="col">Total</th>
          <th scope="col">H. Ext</th>
          <th scope="col" class="w-2">Crud</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="9"></td>
        </tr>
      </tfoot>
    </table>
  </x-blue-board>
@endsection

@section('modals')
  <!-- Modal Asistencia -->
  <div class="modal fade" id="modalAsistencia" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modificar Asistencia</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="asistencia-action">
          @csrf
          @method('PUT')
          <div class="modal-body row">
            <h4 class="col-12 asistencia-usuario">Usuario</h4>
            <h4 class="col-12 asistencia-fecha">Fecha</h4>
            <div class="form-group col-6">
              <label for="llegada_mañana">Llegada mañana</label>
              <input type="time" class="form-control asistencia-entrada_1" name="llegada_mañana" id="llegada_mañana"
                step="1">
            </div>
            <div class="form-group col-6">
              <label for="salida_mañana">Salida mañana</label>
              <input type="time" class="form-control asistencia-salida_1" name="salida_mañana" id="salida_mañana"
                step="1">
            </div>
            <div class="form-group col-6">
              <label for="llegada_tarde">Llegada tarde</label>
              <input type="time" class="form-control asistencia-entrada_2" name="llegada_tarde" id="llegada_tarde"
                step="1">
            </div>
            <div class="form-group col-6">
              <label for="salida_tarde">Salida tarde</label>
              <input type="time" class="form-control asistencia-salida_2" name="salida_tarde" id="salida_tarde" step="1">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Modificar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete Alert -->
  <div class="modal fade" id="deleteAlert" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Eliminar Asistencia</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="asistencia-delete-action">
          @csrf
          @method('DELETE')
          <div class="modal-body">
            <h4>Estas por borrar la asistencia de <span class="asistencia-delete-usuario">usuario</span> de la fecha <span
                class="asistencia-delete-fecha"></span></h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Eliminar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    var saldo = 0;
    var dato_fecha = '';
    var dato_color = '';
    var cambio_color = false;
    const routeAjax = `{{ route('rrhh.api') }}`;
    var table = $('#table').DataTable({
      "paging": true,
      "ordering": true,
      "info": false,
      "responsive": true,
      "ajax": {
        "url": routeAjax,
        "method": 'post',
        "dataSrc": '',
        "data": {
          "fechaini": () => $('#inicio').val(),
          "fechafin": () => $('#fin').val(),
          "usuario": () => $('#usuario').val(),
        },
        // "success": data => {
        //   debugger
        // },
        "error": error => {
          swal('Oops!', 'Ha ocurrido un error al cargar los datos!', 'error');
          console.log(error);
        }
      },
      "columns": [{
          "name": "nombre",
          "data": "nombre"
        },
        {
          "name": "fecha",
          "data": "fecha"
        },
        {
          "name": "entrada_1",
          "data": "entrada_1"
        },
        {
          "name": "salida_1",
          "data": "salida_1"
        },
        {
          "name": "entrada_2",
          "data": "entrada_2"
        },
        {
          "name": "salida_2",
          "data": "salida_2"
        },
        {
          "name": "total",
          "data": "total"
        },
        {
          "name": "extras",
          "data": "extras"
        },
        {
          "name": "crud",
          "data": null,
          "sortable": "false",
          "render": (data, type, full, meta) => {
            let dataJson = JSON.stringify(data);
            let crud =
              `<a class='fa fa-edit' href='#modalAsistencia' data-toggle='modal' data-asistencia='${dataJson}'></a>`;
            crud +=
              `<a class='fa fa-trash' href='#deleteAlert' data-toggle='modal' data-asistencia='${dataJson}'></a>`;
            return crud;
          }
        }
      ],
      "columnDefs": [{
        "responsivePriority": 1,
        "targets": [0, 2, 4, 5]
      }],
      // "rowCallback": function(row, data, index) {
      // cabio de olor por fecha
      // let fecha = data.fecha;
      // let dato_color;

      // if (dato_fecha != fecha) {
      //   dato_fecha = fecha;
      //   cambio_color = !cambio_color;
      // }
      // dato_color = (cambio_color) ? '#6E85B1' : '#69A9C3';
      // $(row).css({'color':''+dato_color +''});
      // }
    });

    const tableReload = () => {
      saldo = 0;
      dato_fecha = '';
      dato_color = '';
      cambio_color = false;
      table.ajax.reload(null, false);
    }

    $('.refresh').change(() => tableReload());

    var route = `{{ route('asistencia.update', 0) }}`;
    $("#modalAsistencia").on('show.bs.modal', event => {
      let data = $(event.relatedTarget).data('asistencia');
      $('#asistencia-action').attr('action', route.replace("/0", "/" + data.id));
      $('.asistencia-usuario').html(data.nombre);
      $('.asistencia-fecha').html(data.fecha);
      $('.asistencia-entrada_1').val(data.entrada_1);
      $('.asistencia-salida_1').val(data.salida_1);
      $('.asistencia-entrada_2').val(data.entrada_2);
      $('.asistencia-salida_2').val(data.salida_2);
    });

    var routeDelete = `{{ route('asistencia.delete', 0) }}`;
    $("#deleteAlert").on('show.bs.modal', event => {
      let data = $(event.relatedTarget).data('asistencia');
      $('#asistencia-delete-action').attr('action', routeDelete.replace("/0", "/" + data.id));
      $('.asistencia-delete-usuario').html(data.nombre);
      $('.asistencia-delete-fecha').html(data.fecha);
    });

    $('#hoy').click(() => {
      $('#inicio').val(moment().format('Y-MM-DD'));
      tableReload();
    });

    $('#semana').click(() => {
      $('#inicio').val(moment().startOf('isoWeek').format('Y-MM-DD'));
      tableReload();
    });

    $('#mes').click(() => {
      $('#inicio').val(moment().format('Y-MM-01'));
      tableReload();
    });
  </script>
@endsection
