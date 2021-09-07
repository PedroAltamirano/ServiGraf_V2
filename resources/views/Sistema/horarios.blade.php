@extends('layouts.app')

@section('links')
@endsection

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Horarios',
      'current' => true,
      'href' => '#',
    ]
  ]"
/>

<x-blue-board
  title='Horarios'
  :foot="[
    ['text'=>'Nuevo', 'href'=>'#modalHorario', 'id'=>'newHorario', 'tipo'=> 'modal'],
  ]"
>
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
        <th scope="col" class="crudCol">Crud</th>
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
        <td><a class='fa fa-edit modHorario' href="#modalHorario" data-toggle="modal"
          data-route='{{ route('horario.update', $item->id) }}'
          data-nombre="{{ $item->nombre }}"
          data-llegada_ma="{{ $item->llegada_ma }}"
          data-salida_ma="{{ $item->salida_ma }}"
          data-llegada_ta="{{ $item->llegada_ta }}"
          data-salida_ta="{{ $item->salida_ta }}"
          data-espera="{{ $item->espera }}"
          data-gracia="{{ $item->gracia }}"
          ></a></td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
    </tfoot>
  </table>
</x-blue-board>

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
              <input type="text" name="nombre" id="nombre" class="form-control modal-nombre @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}">
            </div>
            <div class="form-group col-6">
              <label for="tillegada_mame">Llegada mañana</label>
              <input type="time" name="llegada_ma" id="llegada_ma" class="form-control modal-llegada_ma @error('llegada_ma') is-invalid @enderror" value="{{ old('llegada_ma') }}">
            </div>
            <div class="form-group col-6">
              <label for="salida_ma">Salida mañana</label>
              <input type="time" name="salida_ma" id="salida_ma" class="form-control modal-salida_ma @error('salida_ma') is-invalid @enderror" value="{{ old('salida_ma') }}">
            </div>
            <div class="form-group col-6">
              <label for="llegada_ta">Llegada tarde</label>
              <input type="time" name="llegada_ta" id="llegada_ta" class="form-control modal-llegada_ta @error('llegada_ta') is-invalid @enderror" value="{{ old('llegada_ta') }}">
            </div>
            <div class="form-group col-6">
              <label for="salida_ta">Salida tarde</label>
              <input type="time" name="salida_ta" id="salida_ta" class="form-control modal-salida_ta @error('salida_ta') is-invalid @enderror" value="{{ old('salida_ta') }}">
            </div>
            <div class="form-group col-6">
              <label for="espera">Espera</label>
              <input type="number" max="60" min="" name="espera" id="espera" class="form-control modal-espera @error('espera') is-invalid @enderror" value="{{ old('espera') }}">
            </div>
            <div class="form-group col-6">
              <label for="gracia">gracia</label>
              <input type="number" max="60" min="" name="gracia" id="gracia" class="form-control modal-gracia @error('gracia') is-invalid @enderror" value="{{ old('gracia') }}">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    $('#table').DataTable({
      "paging":   true,
      "ordering": true,
      "info":     false,
      "responsive": true,
    });
  });

  // CATEGORIAS
  $('#newHorario').on('click', function (event) {
    var modal = $('#modalHorario');
    modal.find('.modal-title').html('Nuevo Horario');
    modal.find('.modal-nombre').val('');
    modal.find('.modal-llegada_ma').val('');
    modal.find('.modal-salida_ma').val('');
    modal.find('.modal-llegada_ta').val('');
    modal.find('.modal-salida_ta').val('');
    modal.find('.modal-espera').val('');
    modal.find('.modal-gracia').val('');
    modal.find('.modal-path').attr('action', '{{ route("horario.store") }}');
    modal.find('input[name="_method"]').val('POST');
  });

  $('.modHorario').on('click', function (event) {
    var button = $(this);
    var modal = $('#modalHorario');
    modal.find('.modal-title').html('Modificar Horario');
    modal.find('.modal-nombre').val(button.data('nombre'));
    modal.find('.modal-llegada_ma').val(button.data('llegada_ma'));
    modal.find('.modal-salida_ma').val(button.data('salida_ma'));
    modal.find('.modal-llegada_ta').val(button.data('llegada_ta'));
    modal.find('.modal-salida_ta').val(button.data('salida_ta'));
    modal.find('.modal-espera').val(button.data('espera'));
    modal.find('.modal-gracia').val(button.data('gracia'));
    modal.find('.modal-path').attr('action', button.data('route'));
    modal.find('input[name="_method"]').val('PUT');
  });
</script>
@endsection
