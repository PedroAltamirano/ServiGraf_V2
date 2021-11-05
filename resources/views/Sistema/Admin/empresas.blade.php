@extends('layouts.app')

@section('desktop-content')
  <x-path :items="[ ['text' => 'Empresas', 'current' => true, 'href' => '#'] ]" />

  <x-blue-board title='Claves'
    :foot="[ ['text'=>'Nueva', 'href'=>'#modalEmpresas', 'id'=>'newEmpresa', 'tipo'=>'modal'] ]">
    <table id="table" class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">Ruc</th>
          <th scope="col">Nombre</th>
          <th scope="col">Tipo</th>
          <th scope="col" class="w-2">Crud</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($empresas as $item)
          <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->nombre }}</td>
            <td>{{ $item->tipo_empresa->nombre }}</td>
            <td>
              <x-crud :status="$item->status" routeEdit="#modalEmpresas" :modalEdit="$item"
                :routeDelete="route('empresas.delete', $item->id)" :textDelete="$item->nombre" />
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
  <!-- Modal Empresa -->
  <div id="modalEmpresas" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form action="{{ route('empresas.store') }}" method="post" class="modal-path">
          @csrf
          @method('POST')
          <div class="modal-body">
            <div class="form-row">
              <x-aditional-info text='Empresa' />
              <div class="form-group col-12 col-md-6">
                <label for="id">Ruc</label>
                <input type="text" name="id" id="id" class="form-control @error('id') is-invalid @enderror"
                  value="{{ old('id') }}">
              </div>
              <div class="form-group col-12 col-md-6">
                <label for="nombre">nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror"
                  value="{{ old('nombre') }}">
              </div>
              <div class="form-group col-12 col-md-6">
                <label for="tipo_empresa_id">Tipo</label>
                <select class="form-control @error('tipo_empresa_id') is-invalid @enderror" name="tipo_empresa_id"
                  id="tipo_empresa_id">
                  @foreach ($tipos as $item)
                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-3 col-md-2">
                <label for="statusDiv">Status</label>
                <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
                  <input type="checkbox" class="custom-control-input @error('status') is-invalid @enderror" id="status"
                    name="status" value='1'>
                  <label class="custom-control-label" for="status"></label>
                </div>
              </div>

              <x-aditional-info text='Usuario' />
              {{-- monbre, apellido, cedula, correo --}}
              <div class="form-group col-12 col-md-6">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                  value="{{ old('name') }}">
              </div>
              <div class="form-group col-12 col-md-6">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido"
                  class="form-control @error('apellido') is-invalid @enderror" value="{{ old('apellido') }}">
              </div>
              <div class="form-group col-12 col-md-6">
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" id="usuario" class="form-control @error('usuario') is-invalid @enderror"
                  value="{{ old('usuario') }}">
              </div>
              <div class="form-group col-12 col-md-6">
                <label for="cedula">Cedula</label>
                <input type="number" min="0" name="cedula" id="cedula"
                  class="form-control @error('cedula') is-invalid @enderror" value="{{ old('cedula') }}">
              </div>
              <div class="form-group col-12 col-md-6">
                <label for="correo">Correo</label>
                <input type="text" name="correo" id="correo" class="form-control @error('correo') is-invalid @enderror"
                  value="{{ old('correo') }}">
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
    $('#table').DataTable({
      "paging": true,
      "ordering": true,
      "info": false,
      "responsive": true,
    });

    // CATEGORIAS
    const routeStore = `{{ route('empresas.store') }}`;
    const routeUpdate = `{{ route('empresas.update', 0) }}`;
    $('#modalEmpresas').on('show.bs.modal', event => {
      let data = $(event.relatedTarget).data('modaldata');
      let modal = $(event.target);

      let path = data ? routeUpdate.replace('/0', `/${data.id}`) : routeStore;
      modal.find('.modal-title').html(data ? 'Modificar Empresa' : 'Nueva Empresa');
      modal.find('.modal-path').attr('action', path);
      modal.find("input[name='_method']").val(data ? 'PUT' : 'POST');

      // empresa
      modal.find('#id').val(data?.id || '');
      modal.find('#nombre').val(data?.nombre || '');
      modal.find('#tipo_empresa_id').val(data?.tipo_empresa_id || '');
      modal.find('#status').prop('checked', data?.status || 1);

      // usuario
      nomina = data?.root?.nomina
      modal.find('#name').val(nomina?.nombre || '').prop('disabled', data ? 1 : 0);
      modal.find('#apellido').val(nomina?.apellido || '').prop('disabled', data ? 1 : 0);
      modal.find('#cedula').val(nomina?.cedula || '').prop('disabled', data ? 1 : 0);
      modal.find('#correo').val(nomina?.correo || '').prop('disabled', data ? 1 : 0);
      modal.find('#usuario').val(data?.root?.usuario || '').prop('disabled', data ? 1 : 0);
    });
  </script>
@endsection
