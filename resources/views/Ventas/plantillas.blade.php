@extends('layouts.app')

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Plantillas',
      'current' => true,
      'href' => '#',
    ]
  ]"
/>

<x-blue-board
  title='Plantillas'
  :foot="[
    ['text' => 'Nueva', 'href' => route('plantilla.create'), 'id' => 'nueva', 'tipo' => 'link'],
  ]"
>
  <table id="table" class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">Nombre</th>
        <th scope="col" class="w-5">Crud</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($plantillas as $item)
      <tr>
        <td>{{ $item->nombre }}</td>
        <td>
          <x-crud :routeEdit="route('plantilla.edit', $item->id)" :routeDelete="route('plantilla.delete', $item->id)" :textDelete="$item->nombre" />
          {{-- <x-crud :routeSee="route('.show', $item->id)" :modalSee="$model" :routeEdit="route('plantilla.edit', $item->id)" :routeDelete="route('plantilla.delete', $item->id)" :textDelete="$item->nombre" /> --}}
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
