@extends('layouts.app')

@section('desktop-content')
  <x-path :items="[ ['text' => 'Actividades', 'current' => true, 'href' => '#'] ]" />

  <x-blue-board title='Actividades'
    :foot="[ ['text'=>'Nuevo', 'href'=>route('actividad.create'), 'id'=>'nuevo', 'tipo'=>'link'] ]">
    <table id="table" class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col" class="w-10">Meta</th>
          <th scope="col">Plantilla</th>
          <th scope="col" class="w-2">Crud</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($actividades as $item)
          <tr>
            <td>{{ $item->nombre }}</td>
            <td>{{ $item->meta }}</td>
            <td>{{ $item->plantilla->nombre ?? '' }}</td>
            <td>
              <x-crud :routeEdit="route('actividad.edit', [$item->id])"
                :routeDelete="route('actividad.delete', [$item->id])" :textDelete="$item->nombre" />
            </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
      </tfoot>
    </table>
  </x-blue-board>
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
