@extends('layouts.app')

@section('desktop-content')
  <x-path :items="[ ['text' => 'Nomina', 'current' => true, 'href' => '#'] ]" />

  <x-blue-board title='Nomina'
    :foot="[ ['text'=>'Nuevo', 'href'=>route('nomina.create'), 'id'=>'nuevo', 'tipo'=>'link'], ]">
    <table id="table" class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">Cédula</th>
          <th scope="col">Nombre</th>
          <th scope="col">Cumpleaños</th>
          <th scope="col">Telefono</th>
          <th scope="col">Correo</th>
          <th scope="col">Contrato</th>
          <th scope="col">Salida</th>
          <th scope="col">Cargo</th>
          <th scope="col">Contacto Emergencia</th>
          <th scope="col">Status</th>
          <th scope="col" class="w-2">Crud</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($nominas as $item)
          <tr>
            <td>{{ $item->cedula }}</td>
            <td>{{ $item->full_name }}</td>
            <td>{{ $item->fecha_nacimiento }}</td>
            <td>{{ $item->movil }}</td>
            <td>{{ $item->correo }}</td>
            <td>{{ $item->inicio_labor }}</td>
            <td>{{ $item->fin_labor }}</td>
            <td>{{ $item->cargo }}</td>
            <td>{{ $item->fullEmergencia }}</td>
            <td>{{ config('empresa.status')[$item->status] }}</td>
            <td>
              <x-crud :routeEdit="route('nomina.edit', $item->cedula)" />
            </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
      </tfoot>
    </table>
  </x-blue-board>

  <x-blue-board title='Dotación'
    :foot="[ ['text'=>'Nueva', 'href'=>'#modalDotacion', 'id'=>'newArea', 'tipo'=>'modal'] ]">
    <div class="row">
      @foreach ($dotacion as $item)
        <div class="col-6 col-md-2">
          <x-crud :status="$item->status" routeEdit="#modalDotacion" :modalEdit="$item"
            :routeDelete="route('dotacion.delete', $item->id)" :textDelete="$item->dotacion" />
          &nbsp;&nbsp;{{ $item->dotacion }}
        </div>
      @endforeach
    </div>
  </x-blue-board>
@endsection

@section('modals')
  <!-- Modal Dotacion -->
  <div id="modalDotacion" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form action="{{ route('dotacion.store') }}" method="post" class="modal-path">
          @csrf
          @method('POST')
          <div class="modal-body">
            <div class="form-group">
              <label for="dotacion">Dotación</label>
              <input type="text" name="dotacion" id="dotacion" class="form-control">
            </div>
            <div class="custom-control custom-switch d-flex justify-content-center">
              <input type="checkbox" class="custom-control-input" id="status" name="status" value="1">
              <label class="custom-control-label" for="status">Estado</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary submitbtn">Crear</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    var table = $('#table').DataTable({
      info: false,
      paging: true,
      ordering: true,
      responsive: true,
      dom: "<'row'<'col'l><'col'f>>rt<'row'<'col'B><'col'ip>>",
      buttons: [{
        extend: 'print',
        text: '',
        className: 'fa fa-print',
        title: 'Nomina',
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
        }
      }],
      columnDefs: [{
        "targets": [2, 8, 9],
        "visible": false,
        "searchable": false
      }, ]
    });

    // AREAS
    const routeStore = `{{ route('dotacion.store') }}`;
    const routeUpdate = `{{ route('dotacion.update', 0) }}`;
    $('#modalDotacion').on('show.bs.modal', event => {
      let data = $(event.relatedTarget).data('modaldata');
      let modal = $(event.target);

      let path = data ? routeUpdate.replace('/0', `/${data.id}`) : routeStore;
      modal.find('.modal-title').html(data ? 'Modificar Dotación' : 'Nueva Dotación');
      modal.find('.modal-path').attr('action', path);
      modal.find("input[name='_method']").val(data ? 'PUT' : 'POST');
      modal.find(".submitbtn").html(data ? 'Modificar' : 'Crear');

      modal.find('#dotacion').val(data ? data.dotacion : '');
      modal.find('#status').prop('checked', (data ? Boolean(Number(data.status)) : false));
    });
  </script>
@endsection
