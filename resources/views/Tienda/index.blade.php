@extends('layouts.app')

@section('desktop-content')
  <x-path :items="[ ['text' => 'Catálogo Digital', 'current' => true, 'href' => '#'], ]" />

  <x-blue-board title='Áreas'
    :foot="[ ['text' => 'Modal', 'href' => '#modalName', 'id' => 'newModal', 'tipo' => 'modal', 'condition' => ''], ['text' => 'Nuevo', 'href' => route(''), 'id' => 'nuevo', 'tipo' => 'link'], ['text' => $action, 'href' => '#', 'id' => 'formSubmit', 'tipo' => 'link'], ['text' => 'fas fa-print', 'href' => '#', 'id' => 'mes', 'tipo' => 'button', 'print-target' => 'table'] ]"
    class="d-print-none">
    <table id="table" class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col" class="w-2">Crud</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($productos as $item)
          <tr>
            <td>{{ $item->name }}</td>
            <td>
              <x-crud :status="$item->status" :routeSee="route('.show', $item->id)" :modalSee="$model"
                :routeEdit="route('.edit', $item->id)" :modalEdit="$model" :routeDelete="route('.delete', $item->id)"
                :textDelete="$item->nombre" />
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
@endsection
