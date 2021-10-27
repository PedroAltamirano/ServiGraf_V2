@extends('layouts.app')

@section('desktop-content')
  <x-path :items="[ ['text' => 'Claves', 'current' => true, 'href' => '#'] ]" />

  <x-blue-board title='Claves' :foot="[ ['text'=>'Nueva', 'href'=>'#modalClave', 'id'=>'newClave', 'tipo'=>'modal'] ]">
    <table id="table" class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">Cuenta</th>
          <th scope="col">Usuario</th>
          <th scope="col">Clave</th>
          <th scope="col">Refuerzo</th>
          <th scope="col">URL</th>
          <th scope="col" class="w-2">Crud</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($claves as $item)
          <tr>
            <td>{{ $item->cuenta }}</td>
            <td>{{ $item->usuario }}</td>
            <td>{{ Crypt::decryptString($item->clave) }}</td>
            <td>{{ $item->refuerzo ? Crypt::decryptString($item->refuerzo) : '' }}</td>
            <td>{{ $item->url }}</td>
            <td>
              <x-crud routeEdit="#modalClave" :modalEdit="$item" :routeDelete="route('clave.delete', $item->id)"
                :textDelete="$item->cuenta" />
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
                <input type="text" name="cuenta" id="cuenta" class="form-control @error('cuenta') is-invalid @enderror"
                  value="{{ old('cuenta') }}">
              </div>
              <div class="form-group col-6 col-md-6">
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" id="usuario" class="form-control @error('usuario') is-invalid @enderror"
                  value="{{ old('usuario') }}">
              </div>
              <div class="form-group col-6 col-md-6">
                <label for="clave">Clave</label>
                <input type="text" name="clave" id="clave" class="form-control @error('clave') is-invalid @enderror"
                  value="{{ old('clave') }}">
              </div>
              <div class="form-group col-12 col-md-6">
                <label for="refuerzo">Refuerzo</label>
                <input type="text" name="refuerzo" id="refuerzo"
                  class="form-control @error('refuerzo') is-invalid @enderror" value="{{ old('refuerzo') }}">
              </div>
              <div class="form-group col-12 col-md-6">
                <label for="url">Url</label>
                <input type="text" name="url" id="url" class="form-control @error('url') is-invalid @enderror"
                  value="{{ old('url') }}">
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
    const routeStore = `{{ route('clave.store') }}`;
    const routeUpdate = `{{ route('clave.update', 0) }}`;
    $('#modalClave').on('show.bs.modal', event => {
      let data = $(event.relatedTarget).data('modaldata');
      let modal = $(event.target);

      let path = data ? routeUpdate.replace('/0', `/${data.id}`) : routeStore;
      modal.find('.modal-title').html(data ? 'Modificar Clave' : 'Nueva Clave');
      modal.find('.modal-path').attr('action', path);
      modal.find("input[name='_method']").val(data ? 'PUT' : 'POST');
      modal.find(".submitbtn").html(data ? 'Modificar' : 'Crear');

      modal.find('#cuenta').val(data ? data.cuenta : '');
      modal.find('#usuario').val(data ? data.usuario : '');
      modal.find('#clave').val(data ? data.clave : '');
      modal.find('#refuerzo').val(data ? data.refuerzo : '');
      modal.find('#url').val(data ? data.url : '');
    });
  </script>
@endsection
