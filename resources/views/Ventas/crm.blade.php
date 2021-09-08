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
    <table id="table" class="table table-striped table-sm">
      <thead>
      </thead>
      <tbody>
        @foreach ($atrasadas as $item)
        <tr>
          <td class="dateCol">{{ $item->fecha }}</td>
          <td class="dateCol">{{ $item->hora }}</td>
          <td>{{ $item->contacto_formated }}</td>
          <td>{{ $item->actividad->nombre }}</td>
          <td>{{ $item->asignado->usuario }}</td>
          <td class="crudCol">
            <x-crud :routeEdit="route('crm.edit', [$item->id])" />
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
    <table id="table" class="table table-striped table-sm">
      <thead>
      </thead>
      <tbody>
        @foreach ($hoy as $item)
        <tr>
          <td class="dateCol">{{ $item->fecha }}</td>
          <td class="dateCol">{{ $item->hora }}</td>
          <td>{{ $item->contacto_formated }}</td>
          <td>{{ $item->actividad->nombre }}</td>
          <td>{{ $item->asignado->usuario }}</td>
          <td class="crudCol">
            <x-crud :routeEdit="route('crm.edit', [$item->id])" />
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
    <table id="table" class="table table-striped table-sm">
      <thead>
      </thead>
      <tbody>
        @foreach ($semana as $item)
        <tr>
          <td class="dateCol">{{ $item->fecha }}</td>
          <td class="dateCol">{{ $item->hora }}</td>
          <td>{{ $item->contacto_formated }}</td>
          <td>{{ $item->actividad->nombre }}</td>
          <td>{{ $item->asignado->usuario }}</td>
          <td class="crudCol">
            <x-crud :routeEdit="route('crm.edit', [$item->id])" />
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
    <table id="table" class="table table-striped table-sm">
      <thead>
      </thead>
      <tbody>
        @foreach ($proximas as $item)
        <tr>
          <td class="dateCol">{{ $item->fecha }}</td>
          <td class="dateCol">{{ $item->hora }}</td>
          <td>{{ $item->contacto_formated }}</td>
          <td>{{ $item->actividad->nombre }}</td>
          <td>{{ $item->asignado->usuario }}</td>
          <td class="crudCol">
            <x-crud :routeEdit="route('crm.edit', [$item->id])" />
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
@endsection
