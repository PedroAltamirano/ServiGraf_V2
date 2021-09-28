@extends('layouts.app')

@section('desktop-content')
  <x-path :items="[
        [
          'text' => 'Pedidos',
          'current' => true,
          'href' => route('pedidos'),
        ]
      ]" />

  <x-blue-board title='Pendientes' :foot="[
        ['text'=>'Nuevo', 'href'=>route('pedido.create'), 'id'=>'nuevo', 'tipo'=>'link'],
      ]">
    <table id="table" class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">Numero</th>
          <th scope="col">Cliente</th>
          <th scope="col" class="w-25">Detalle</th>
          <th scope="col">Cant</th>
          <th scope="col" class="w-40">Procesos</th>
          <th scope="col" class="w-2">Crud</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pedidos as $item)
          <tr>
            <td>{{ $item->numero }}</td>
            <td>{{ $item->cliente->bussiness_name }}</td>
            <td>{{ $item->detalle }}</td>
            <td>{{ $item->cantidad }}</td>
            <td>{{ implode(', ', $item->procesos_incompletos_nombre) }}</td>
            <td>
              <x-crud routeSee="#modalPedido" :modalSee="$item->id" :routeEdit="route('pedido.edit', $item->numero)" />
            </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
      </tfoot>
    </table>
  </x-blue-board>
@endsection

@section('modals')
  <x-modal-pedido />
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
