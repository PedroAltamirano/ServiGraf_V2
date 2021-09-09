@extends('layouts.app')

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'CRM',
      'current' => true,
      'href' => '#',
    ]
  ]"
/>

<x-blue-board
  title='Tareas'
  :foot="[
    ['text'=>'Nueva', 'href'=>'#modalTarea', 'id'=>'newTarea', 'tipo'=> 'modal'],
  ]"
>
  @if ($atrasadas->count())
  <x-aditional-info text='Atrasadas' />
  <div class="table-responsive">
    <table id="table" class="table table-responsive table-striped table-sm">
      <thead>
      </thead>
      <tbody>
        @foreach ($atrasadas as $item)
        <tr>
          <td class="w-10">{{ $item->fecha }}</td>
          <td class="w-10">{{ $item->hora }}</td>
          <td>{{ $item->contacto_formated }}</td>
          <td>{{ $item->actividad->nombre }}</td>
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
  @endif

  <x-aditional-info text='Hoy' />
  <div class="table-responsive">
    <table id="table" class="table table-responsive table-striped table-sm">
      <thead>
      </thead>
      <tbody>
        @foreach ($hoy as $item)
        <tr>
          <td class="w-10">{{ $item->fecha }}</td>
          <td class="w-10">{{ $item->hora }}</td>
          <td>{{ $item->contacto_formated }}</td>
          <td>{{ $item->actividad->nombre }}</td>
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

  <x-aditional-info text='Semana' />
  <div class="table-responsive">
    <table id="table" class="table table-responsive table-striped table-sm">
      <thead>
      </thead>
      <tbody>
        @foreach ($semana as $item)
        <tr>
          <td class="w-10">{{ $item->fecha }}</td>
          <td class="w-10">{{ $item->hora }}</td>
          <td>{{ $item->contacto_formated }}</td>
          <td>{{ $item->actividad->nombre }}</td>
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

  <x-aditional-info text='Proximas' />
  <div class="table-responsive">
    <table id="table" class="table table-responsive table-striped table-sm">
      <thead>
      </thead>
      <tbody>
        @foreach ($proximas as $item)
        <tr>
          <td class="w-10">{{ $item->fecha }}</td>
          <td class="w-10">{{ $item->hora }}</td>
          <td>{{ $item->contacto_formated }}</td>
          <td>{{ $item->actividad->nombre }}</td>
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
</x-blue-board>
@endsection

@section('modals')
<x-add-tarea />
<x-add-contacto />
@endsection

@section('scripts')
<script>
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
