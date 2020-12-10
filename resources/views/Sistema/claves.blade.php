@extends('layouts.app')

@section('links')
@endsection

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Claves',
      'current' => true,
      'href' => '#',
    ]
  ]"
/>

<x-blueBoard
  title='Claves'
  :foot="[
    ['text'=>'Nueva', 'href'=>'#modalClave', 'id'=>'newClave', 'tipo'=> 'modal'],
  ]"
>
  <table id="table" class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">Cuenta</th>
        <th scope="col">Usuario</th>
        <th scope="col">Clave</th>
        <th scope="col">Refuerzo</th>
        <th scope="col">URL</th>
        <th scope="col" class="crudCol">Crud</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($claves as $item)
      <tr>
        <td>{{ $item->cuenta }}</td>
        <td>{{ $item->usuario }}</td>
        <td>{{ Crypt::decryptString($item->clave) }}</td>
        <td>{{ Crypt::decryptString($item->refuerzo) }}</td>
        <td>{{ $item->url }}</td>
        <td><a class='fa fa-edit modClave' href="#modalClave" data-toggle="modal"
          data-route='{{ route('clave.update', $item->id) }}' 
          data-cuenta="{{ $item->cuenta }}" 
          data-usuario="{{ $item->usuario }}" 
          data-clave="{{ Crypt::decryptString($item->clave) }}" 
          data-refuerzo="{{ Crypt::decryptString($item->refuerzo) }}" 
          data-url="{{ $item->url }}"></a> <a class='fa fa-trash delClave' href="#deleteAlert" data-toggle="modal" data-route="{{ route('clave.delete', $item->id) }}"></a></td>
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
</div>

<!-- danger modal -->
<div class="modal fade" id="deleteAlert" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h4 class="modal-title text-white"><i class="fe-alert-triangle mr-2"></i> Eliminar Clave</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <form action="#" method="POST" role="form" class="modal-path">
        @csrf
        @method('DELETE')
        <div class="modal-body">
            <div class="text-danger">Está seguro que desea eliminar esta clave?</div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
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
  $('#newClave').on('click', function (event) {
    var modal = $('#modalClave');
    modal.find('.modal-title').html('Nueva Clave');
    modal.find('.modal-cuenta').val('');
    modal.find('.modal-usuario').val('');
    modal.find('.modal-clave').val('');
    modal.find('.modal-refuerzo').val('');
    modal.find('.modal-url').val('');
    modal.find('.modal-path').attr('action', '{{ route("clave.store") }}');
    modal.find('input[name="_method"]').val('POST');
  });

  $('.modClave').on('click', function (event) {
    var button = $(this);
    var modal = $('#modalClave');
    modal.find('.modal-title').html('Modificar Clave');
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