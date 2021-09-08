@extends('layouts.app')

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Actividades',
      'current' => true,
      'href' => '#',
    ]
  ]"
/>

<x-blue-board
  title='Actividades'
  :foot="[
    ['text'=>'Nuevo', 'href'=>route('actividad.create'), 'id'=>'nuevo', 'tipo'=> 'link'],
  ]"
>
  <table id="table" class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col" class="crudCol">Crud</th>
      </tr>
    </thead>
    <tbody>
      {{-- @foreach ($ as $item)
      <tr>
        <td>{{ $item-> }}</td>
        <td>
          <x-crud :routeSee='route(.edit, [$->id])', :modalSee='$model', :routeEdit='route(.edit, [$->id])', :modalEdit='$model', :routeDelete='route(.edit, [$->id])' />
        </td>
      </tr>
      @endforeach --}}
    </tbody>
    <tfoot>
    </tfoot>
  </table>
</x-blue-board>
@endsection

@section('scripts')
@endsection
