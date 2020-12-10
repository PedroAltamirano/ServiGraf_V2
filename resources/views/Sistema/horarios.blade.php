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

<x-blueBoard
  title='Horarios'
  :foot="[
    ['text'=>'Nuevo', 'href'=>'#modalHorario', 'id'=>'newHorario', 'tipo'=> 'modal'],
  ]"
>
  <table id="table" class="table table-striped table-sm">
    <thead>
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
</x-blueBoard>

<!-- Modal CATEGORIA -->
<div id="modalClave" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{ route('clave.store') }}" method="post" class="modal-path" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-6 col-md-6">
              <label for="cuenta">Cuenta</label>
              <input type="text" name="cuenta" id="cuenta" class="form-control modal-cuenta @error('cuenta') is-invalid @enderror" value="{{ old('cuenta') }}">
            </div>
            <div class="form-group col-6 col-md-6">
              <label for="usuario">Usuario</label>
              <input type="text" name="usuario" id="usuario" class="form-control modal-usuario @error('usuario') is-invalid @enderror" value="{{ old('usuario') }}">
            </div>
            <div class="form-group col-6 col-md-6">
              <label for="clave">Clave</label>
              <input type="text" name="clave" id="clave" class="form-control modal-clave @error('clave') is-invalid @enderror" value="{{ old('clave') }}">
            </div>
            <div class="form-group col-12 col-md-6">
              <label for="refuerzo">Refuerzo</label>
              <input type="text" name="refuerzo" id="refuerzo" class="form-control modal-refuerzo @error('refuerzo') is-invalid @enderror" value="{{ old('refuerzo') }}">
            </div>
            <div class="form-group col-12 col-md-6">
              <label for="url">Url</label>
              <input type="text" name="url" id="url" class="form-control modal-url @error('url') is-invalid @enderror" value="{{ old('url') }}">
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
<Horario
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
    modal.find('.modal-title').html('Nueva Horario');
    modal.find('.modal-cuenta').val('');
    modal.find('.modal-usuario').val('');
    modal.find('.modal-clave').val('');
    modal.find('.modal-refuerzo').val('');
    modal.find('.modal-url').val('');
    modal.find('.modal-path').attr('action', '{{ route("clave.store") }}');
    modal.find('input[name="_method"]').val('POST');
  });

  $('.modHorario').on('click', function (event) {
    var button = $(this);
    var modal = $('#modalHorario');
    modal.find('.modal-title').html('Modificar Horario');
    modal.find('.modal-cuenta').val(button.data('cuenta'));
    modal.find('.modal-usuario').val(button.data('usuario'));
    modal.find('.modal-clave').val(button.data('clave'));
    modal.find('.modal-refuerzo').val(button.data('refuerzo'));
    modal.find('.modal-url').val(button.data('url'));
    modal.find('.modal-path').attr('action', button.data('route'));
    modal.find('input[name="_method"]').val('PUT');
  });

  $('.delClave').on('click', function (event) {
    var button = $(this);
    var modal = $('#deleteAlert');
    modal.find('.modal-path').attr('action', button.data('route'));
  });

</script>
@endsection