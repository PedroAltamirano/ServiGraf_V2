@extends('layouts.app')

@section('desktop-content')
{{-- <x-errors />
<x-fab /> --}}

<x-path :items="[ ['text' => 'Libro Diario', 'current' => false, 'href' => route('libro')], ['text' => 'Entrada', 'current' => true, 'href' => '#'] ]"
/>

<x-blue-board
  title='Áreas'
  :foot="[ ['text' => 'Modal', 'href' => '#modalName', 'id' => 'newModal', 'tipo' => 'modal', 'condition' => ''], ['text' => 'Nuevo', 'href' => route(''), 'id' => 'nuevo', 'tipo' => 'link'], ['text' => $action, 'href' => '#', 'id' => 'formSubmit', 'tipo' => 'link'], ['text' => 'fas fa-print', 'href' => '#', 'id' => 'mes', 'tipo' => 'button', 'print-target' => 'table'] ]"
  class="d-print-none"
>
  <form action="{{ $path }}" method="POST" id="form">
    @csrf
    @method($method)
    @include('Produccion.formPedido')
  </form>

  <table id="table" class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col" class="w-2">Crud</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($ as $item)
      <tr>
        <td>{{ $item-> }}</td>
        <td>
          <!-- TODO: modificar componente, de classSee/classEdit a status -->
          <x-crud :status="$item->status" :routeSee="route('.show', $item->id)" :modalSee="$model" :routeEdit="route('.edit', $item->id)" :modalEdit="$model" :routeDelete="route('.delete', $item->id)" :textDelete="$item->nombre" />
        </td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
    </tfoot>
  </table>
</x-blue-board>

<x-cliente column='cliente_id' :old="old('cliente_id', $factura->cliente_id)" />

<x-report :title="$cli->contacto->nombre.' '.$cli->contacto->apellido" :items="$items"></x-report>

<x-add-contacto />

<x-filters cli=1 cob=1>

<x-recibo />

<x-procesos label='Proceso padre' name='parent_id' :old="old('parent_id', $proceso->parent_id)" />

<x-add-proveedor />

<x-procesos-area id='procesos' name='proceso_id[]' :old='$pedido->proceso_id' />

<x-aditional-info text='' />

<x-comentarios :comentarios="$comentarios" />
<x-add-comentario :contactoId="$contacto->id" />

@endsection

@section('modals')
@endsection

@section('scripts')
@endsection

@section('after.scripts')
@endsection
