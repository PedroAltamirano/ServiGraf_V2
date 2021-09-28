@extends('layouts.app')

@section('desktop-content')
  <x-path :items="[
      [
        'text' => 'Procesos',
        'current' => true,
        'href' => route('procesos'),
      ]
    ]" />

  <x-blue-board title='Áreas' :foot="[
      ['text'=>'Nueva', 'href'=>'#modalArea', 'id'=>'newArea', 'tipo'=>'modal'],
    ]">
    <div class="row">
      @foreach ($areas as $item)
        <div class="col-6 col-md-2">
          <x-crud routeEdit="#modalArea" :modalEdit="$item" :routeDelete="route('area.delete', $item->id)"
            :textDelete="$item->area" />
          &nbsp;&nbsp;{{ $item->area }}
        </div>
      @endforeach
    </div>
  </x-blue-board>

  <x-blue-board title='Procesos' :foot="[
      ['text'=>'Nuevo', 'href'=>route('proceso.create'), 'id'=>'nuevo', 'tipo'=>'link'],
    ]">
    <table id="tableProcesos" class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">Area</th>
          <th scope="col">Padre</th>
          <th scope="col">Proceso</th>
          <th scope="col">Meta $</th>
          <th scope="col">T xM</th>
          <th scope="col">T xO</th>
          <th scope="col">Tipo</th>
          <th scope="col" class="w-2">Seguimiento</th>
          <th scope="col" class="w-2">Crud</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($procesos as $item)
          <tr>
            <td>{{ $item->area->area }}</td>
            <td>{{ $item->parent->proceso ?? '' }}</td>
            <td>{{ $item->proceso }}</td>
            <td>{{ $item->meta }}</td>
            <td>{{ $item->tmaquina ?? '' }}</td>
            <td>{{ $item->toperador ?? '' }}</td>
            <td>{{ $item->tipo ? 'Interno' : 'Externo' }}</td>
            <td><i class="{{ $item->seguimiento ? 'fas fa-check' : 'fas fa-times' }}"></i></td>
            <td>
              <x-crud :routeEdit="route('proceso.edit', $item->id)" :routeDelete="route('proceso.delete', $item->id)"
                :textDelete="$item->proceso" />
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
  <!-- Modal AREAS -->
  <div id="modalArea" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form action="{{ route('area.store') }}" method="post" class="modal-path">
          @csrf
          @method('POST')
          <div class="modal-body">
            <div class="form-group">
              <label for="area">Área</label>
              <input type="text" name="area" id="area" class="form-control">
            </div>
            <div class="form-group">
              <label for="orden">Orden</label>
              <input type="number" name="orden" id="orden" class="form-control">
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
    $('#tableProcesos').DataTable({
      "paging": true,
      "ordering": true,
      "info": false,
      "responsive": true,
    });

    // AREAS
    const routeStore = `{{ route('area.store') }}`;
    const routeUpdate = `{{ route('area.update', 0) }}`;
    $('#modalArea').on('show.bs.modal', event => {
      let data = $(event.relatedTarget).data('modaldata');
      let modal = $(event.target);

      let path = data ? routeUpdate.replace('/0', `/${data.id}`) : routeStore;
      modal.find('.modal-title').html(data ? 'Modificar Área' : 'Nueva Área');
      modal.find('.modal-path').attr('action', path);
      modal.find("input[name='_method']").val(data ? 'PUT' : 'POST');
      modal.find(".submitbtn").html(data ? 'Modificar' : 'Crear');

      modal.find('#area').val(data ? data.area : '');
      modal.find('#orden').val(data ? data.orden : '');
    });
  </script>
@endsection
