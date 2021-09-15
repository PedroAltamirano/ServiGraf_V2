@extends('layouts.app')

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Contactos',
      'current' => false,
      'href' => route('contacto'),
    ],
    [
      'text' => $contacto->full_name,
      'current' => true,
      'href' => '#',
    ]
  ]"
/>

<x-blue-board
  title='Contacto'
  :foot="[
    ['text' => 'Nueva Tarea', 'href' => '#modalTarea', 'id' => 'newTarea', 'tipo' => 'modal'],
    ['text' => 'Nuevo Comentario', 'href' => '#modalComentario', 'id' => 'newComentario', 'tipo' => 'modal'],
  ]"
>
  @include('Ventas._contacto')

  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-link" id="nav-tareas-tab" data-toggle="tab" href="#nav-tareas" role="tab" aria-controls="nav-tareas" aria-selected="true">Tareas</a>
      <a class="nav-link active" id="nav-comentarios-tab" data-toggle="tab" href="#nav-comentarios" role="tab" aria-controls="nav-comentarios" aria-selected="false">Comentarios</a>
      <div class="flex-fill"></div>
      <a class="nav-link" href="{{ route('crm') }}">CRM</a>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade pt-3" id="nav-tareas" role="tabpanel" aria-labelledby="nav-tareas-tab">
      <table id="table" class="table table-striped table-sm w-100">
        <thead>
          <th scope="col" class="w-10">Fecha</th>
          <th scope="col" class="w-10">Hora</th>
          <th scope="col">Tarea</th>
          <th scope="col">Nota</th>
          <th scope="col">Asignado</th>
          <th scope="col" class="w-5">Crud</th>
        </thead>
        <tbody>
          @foreach ($tareas as $item)
          <tr>
            <td class="w-10">{{ $item->fecha }}</td>
            <td class="w-10">{{ $item->hora }}</td>
            <td>{{ $item->actividad->nombre }}</td>
            <td>{{ $item->nota }}</td>
            <td>{{ $item->asignado->usuario }}</td>
            <td class="w-5">
              <x-crud routeEdit="#modalTarea" :modalEdit="$item" />
            </td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
        </tfoot>
      </table>
    </div>

    <div class="tab-pane fade pt-3 show active" id="nav-comentarios" role="tabpanel" aria-labelledby="nav-comentarios-tab">
      @foreach ($comentarios as $item)
      <x-chat :avatar="$item->nomina->avatar" :nombre="$item->creador->usuario" :mssg="$item->comentario"  />
      @endforeach
    </div>

    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
  </div>
</x-blue-board>
@endsection

@section('modals')
  <x-add-tarea />

  <!-- Modal comentario -->
  <div class="modal fade" id="modalComentario" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <form method="POST" action="{{ route('comentario.store') }}" role="form" id="form">
          @csrf
          @method('POST')
          <div class="modal-body">
            <input type="hidden" name="comentario_id" id="comentario_id">
            <input type="hidden" name="contacto_id" id="contacto_id" value="{{ $contacto->id }}">
            <div class="form-group">
              <label for="comentario">Comentario</label>
              <input type="text" class="form-control @error('comentario') is-invalid @enderror" name="comentario" id="comentario" value="{{ old('comentario') }}" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary submitbtn">Crear</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
  $('#table').DataTable({
    "info": false,
    "paging": true,
    "ordering": true,
    "responsive": true,
  });


  const routeStoreComentario = `{{ route('comentario.store') }}`;
  const routeEditComentario = `{{ route('comentario.update', 0) }}`;
  $('#modalComentario').on('show.bs.modal', event => {
    let data = $(event.relatedTarget).data('modaldata');
    let comentario_id = $(event.relatedTarget).data('comentario_id');
    let modal = $(event.target);

    let path = data ? routeEditComentario.replace('/0', `/${data.id}`) : routeStoreComentario;
    modal.find('#form').attr('action', path);
    modal.find("input[name='_method']").val(data ? 'PUT' : 'POST');
    modal.find(".submitbtn").html(data ? 'Modificar' : 'Crear');

    modal.find('#comentario_id').val(data ? data.comentario_id : comentario_id);
    modal.find('#comentario').val(data ? data.comentario : '');
  });
</script>
@endsection
