@extends('layouts.app')

@section('desktop-content')
  <x-path :items="[
      [
        'text' => 'Horarios',
        'current' => true,
        'href' => '#',
      ]
    ]" />

  <x-blue-board title='Horarios' :foot="[
      ['text'=>'Nuevo', 'href'=>'#modalHorario', 'id'=>'newHorario', 'tipo'=>'modal'],
    ]">
    <table id="table" class="table table-striped table-sm">
      <thead>
        <tr>
          <td></td>
          <td colspan="2">Jornada matutina</td>
          <td colspan="2">Jornada vespertina</td>
          <td colspan="3"></td>
        </tr>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Llegada</th>
          <th scope="col">Salida</th>
          <th scope="col">Legada</th>
          <th scope="col">Salida</th>
          <th scope="col">Espera</th>
          <th scope="col">Gracia</th>
          <th scope="col" class="w-2">Crud</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($horarios as $item)
          <tr>
            <td>{{ $item->nombre }}</td>
            <td>{{ $item->llegada_ma }}</td>
            <td>{{ $item->salida_ma }}</td>
            <td>{{ $item->llegada_ta }}</td>
            <td>{{ $item->salida_ta }}</td>
            <td>{{ $item->espera }}</td>
            <td>{{ $item->gracia }}</td>
            <td>
              <x-crud routeEdit="#modalHorario" :modalEdit="$item" />
            </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
      </tfoot>
    </table>
  </x-blue-board>
@endsection

@section('modals')
  <!-- Modal CATEGORIA -->
  <div id="modalHorario" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form action="{{ route('horario.store') }}" method="post" class="modal-path">
          @csrf
          @method('POST')
          <div class="modal-body">
            <div class="form-row">
              <div class="form-group col-12">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror"
                  value="{{ old('nombre') }}">
              </div>
              <div class="form-group col-6">
                <label for="tillegada_mame">Llegada mañana</label>
                <input type="time" name="llegada_ma" id="llegada_ma"
                  class="form-control @error('llegada_ma') is-invalid @enderror" value="{{ old('llegada_ma') }}">
              </div>
              <div class="form-group col-6">
                <label for="salida_ma">Salida mañana</label>
                <input type="time" name="salida_ma" id="salida_ma"
                  class="form-control @error('salida_ma') is-invalid @enderror" value="{{ old('salida_ma') }}">
              </div>
              <div class="form-group col-6">
                <label for="llegada_ta">Llegada tarde</label>
                <input type="time" name="llegada_ta" id="llegada_ta"
                  class="form-control @error('llegada_ta') is-invalid @enderror" value="{{ old('llegada_ta') }}">
              </div>
              <div class="form-group col-6">
                <label for="salida_ta">Salida tarde</label>
                <input type="time" name="salida_ta" id="salida_ta"
                  class="form-control @error('salida_ta') is-invalid @enderror" value="{{ old('salida_ta') }}">
              </div>
              <div class="form-group col-6">
                <label for="espera">Espera</label>
                <input type="number" max="60" min="" name="espera" id="espera"
                  class="form-control @error('espera') is-invalid @enderror" value="{{ old('espera') }}">
              </div>
              <div class="form-group col-6">
                <label for="gracia">gracia</label>
                <input type="number" max="60" min="" name="gracia" id="gracia"
                  class="form-control @error('gracia') is-invalid @enderror" value="{{ old('gracia') }}">
              </div>
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
    $('#table').DataTable({
      "paging": true,
      "ordering": true,
      "info": false,
      "responsive": true,
    });

    // CATEGORIAS
    const routeStore = `{{ route('horario.store') }}`;
    const routeUpdate = `{{ route('horario.update', 0) }}`;
    $('#modalHorario').on('show.bs.modal', event => {
      let data = $(event.relatedTarget).data('modaldata');
      let modal = $(event.target);

      let path = data ? routeUpdate.replace('/0', `/${data.id}`) : routeStore;
      modal.find('.modal-title').html(data ? 'Modificar Horario' : 'Nueva Horario');
      modal.find('.modal-path').attr('action', path);
      modal.find("input[name='_method']").val(data ? 'PUT' : 'POST');
      modal.find(".submitbtn").html(data ? 'Modificar' : 'Crear');

      let llegada_ma = data ? moment(data.llegada_ma, "HH:mm:ss").format('HH:mm') : '';
      let salida_ma = data ? moment(data.salida_ma, "HH:mm:ss").format('HH:mm') : '';
      let llegada_ta = data ? moment(data.llegada_ta, "HH:mm:ss").format('HH:mm') : '';
      let salida_ta = data ? moment(data.salida_ta, "HH:mm:ss").format('HH:mm') : '';
      modal.find('#nombre').val(data ? data.nombre : '');
      modal.find('#llegada_ma').val(llegada_ma);
      modal.find('#salida_ma').val(salida_ma);
      modal.find('#llegada_ta').val(llegada_ta);
      modal.find('#salida_ta').val(salida_ta);
      modal.find('#espera').val(data ? data.espera : '');
      modal.find('#gracia').val(data ? data.gracia : '');
    });
  </script>
@endsection
