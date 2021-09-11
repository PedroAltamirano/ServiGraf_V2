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
  :foot="[]"
>
  @include('Ventas._contacto')

  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <div class="nav-link">
        <a class="fas fa-plus" href="#modalTarea" data-toggle="modal"></a>
      </div>

      <a class="nav-link" id="nav-tareas-tab" data-toggle="tab" href="#nav-tareas" role="tab" aria-controls="nav-tareas" aria-selected="true">Tareas</a>
      <a class="nav-link active" id="nav-comentarios-tab" data-toggle="tab" href="#nav-comentarios" role="tab" aria-controls="nav-comentarios" aria-selected="false">Comentarios</a>

      <a class="nav-link" href="{{ route('contacto') }}">CRM</a>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade pt-3" id="nav-tareas" role="tabpanel" aria-labelledby="nav-tareas-tab">
      <table id="table" class="table table-striped table-sm">
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
              <x-crud routeEdit="#modalTarea" :modalEdit="$item" classEdit="editTarea" />
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
@endsection

@section('scripts')
<script>
  $('#table').DataTable({
    "info": false,
    "paging": true,
    "ordering": true,
    "responsive": true,
  });

  const routeStore = `{{ route('crm.store') }}`;
  const routeEdit = `{{ route('crm.update', 0) }}`;
  $('#modalTarea').on('show.bs.modal', event => {
    let data = $(event.relatedTarget).data('modaldata');
    let modal = $(event.target);

    let path = data ? routeEdit.replace('/0', `/${data.id}`) : routeStore;
    modal.find('#tareaForm').attr('action', path);
    modal.find("input[name='_method']").val(data ? 'PUT' : 'POST');
    modal.find(".submitbtn").html(data ? 'Modificar' : 'Crear');

    let time = data ? moment(data.hora, "HH:mm:ss").format('HH:mm') : '';
    modal.find('#contacto_id').val(data ? data.contacto.id : '');
    modal.find('#contacto_id').trigger('change.select2');
    modal.find('#contacto_id').trigger('change');
    modal.find('#actividad_id').val(data ? data.actividad.id : '');
    modal.find('#asignado_id').val(data ? data.asignado.cedula : '');
    modal.find('#estado').val(data ? data.estado : '');
    modal.find('#fecha').val(data ? data.fecha : '');
    modal.find('#hora').val(time);
    modal.find('#nota').val(data ? data.nota : '');
  });
</script>
@endsection
