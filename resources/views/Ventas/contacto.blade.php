@extends('layouts.app')

@section('desktop-content')
  <x-path :items="[
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
    ]" />

  <x-blue-board title='Contacto' :foot="[
      ['text' => 'Nueva Tarea', 'href' => '#modalTarea', 'id' => 'newTarea', 'tipo' => 'modal'],
      ['text' => 'Nuevo Comentario', 'href' => '#modalComentario', 'id' => 'newComentario', 'tipo' => 'modal'],
    ]">
    @include('Ventas._contacto')

    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-link active" id="nav-tareas-tab" data-toggle="tab" href="#nav-tareas" role="tab"
          aria-controls="nav-tareas" aria-selected="true">Tareas</a>
        <a class="nav-link" id="nav-comentarios-tab" data-toggle="tab" href="#nav-comentarios" role="tab"
          aria-controls="nav-comentarios" aria-selected="false">Comentarios</a>
        <div class="flex-fill"></div>
        <a class="nav-link" href="{{ route('crm') }}">CRM</a>
      </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade pt-3 show active" id="nav-tareas" role="tabpanel" aria-labelledby="nav-tareas-tab">
        <table id="table" class="table table-striped table-sm w-100">
          <thead>
            <th scope="col" class="w-10">Fecha</th>
            <th scope="col" class="w-10">Hora</th>
            <th scope="col">Tarea</th>
            <th scope="col">Nota</th>
            <th scope="col">Asignado</th>
            <th scope="col" class="w-2">Crud</th>
          </thead>
          <tbody>
            @foreach ($tareas as $item)
              <tr>
                <td class="w-10">{{ $item->fecha }}</td>
                <td class="w-10">{{ $item->hora }}</td>
                <td>{{ $item->actividad->nombre }}</td>
                <td>{{ $item->nota }}</td>
                <td>{{ $item->asignado->usuario }}</td>
                <td class="w-2">
                  <x-crud routeEdit="#modalTarea" :modalEdit="$item" />
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
          </tfoot>
        </table>
      </div>

      <div class="tab-pane fade pt-3" id="nav-comentarios" role="tabpanel" aria-labelledby="nav-comentarios-tab">
        <x-comentarios :comentarios="$comentarios" />
      </div>

      <div class="tab-pane fade pt-3" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
    </div>
  </x-blue-board>
@endsection

@section('modals')
  <x-add-tarea />
  <x-add-comentario :contactoId="$contacto->id" />
@endsection

@section('scripts')
  <script>
    $('#table').DataTable({
      "info": false,
      "paging": true,
      "ordering": true,
      "responsive": true,
    });
  </script>
@endsection
