@extends('layouts.app')

@section('desktop-content')
  <x-path :items="[
      [
        'text' => session('userInfo.nomina'),
        'current' => true,
        'href' => '#',
      ]
    ]" />

  @if (count($procesos) > 0)
    @php
      $colors = ['bg-success', 'bg-info', 'bg-warning', 'bg-danger'];
    @endphp
    @foreach ($procesos as $item)
      @php
        $logrado = App\Models\Produccion\Pedido_proceso::where('status', 1)
            ->whereBetween('created_at', [date('Y-m-01'), date('Y-m-d')])
            ->where('proceso_id', $item->id)
            ->sum('total');
        $prog = ($logrado * 100) / $item->meta;
        $ci = $loop->index % count($colors);
      @endphp
      <div class="m-2 m-md-3">
        <label for="meta">Producción {{ $item->proceso }} ${{ $item->meta }}</label>
        <div class="progress" style="height: 30px;" id="meta">
          <div class="progress-bar progress-bar-striped progress-bar-animated {{ $colors[$ci] }}" role="progressbar"
            style="width: {{ $prog }}%" aria-valuenow="{{ $logrado }}" aria-valuemin="0"
            aria-valuemax="{{ $item->meta }}">{{ $logrado }}</div>
        </div>
      </div>
    @endforeach
  @endif

  @if (count($procesos) > 0)
    <x-blue-board title='Pendientes' :foot="[
      ['text'=>'Nuevo', 'href'=>route('pedido.create'), 'id'=>'nuevo', 'tipo'=>'link'],
    ]">
      <table id="table" class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">Numero</th>
            <th scope="col">Cliente</th>
            <th scope="col" style="width: 25%">Detalle</th>
            <th scope="col">Cant</th>
            <th scope="col" style="width: 40%">Procesos</th>
            <th scope="col" class="w-2">Crud</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pedidos as $item)
            <tr>
              <td>{{ $item->numero }}</td>
              <td>{{ $item->cliente->bussiness_name ?? '' }}</td>
              <td>{{ $item->detalle }}</td>
              <td>{{ $item->cantidad }}</td>
              <td>{{ implode(', ', $item->procesos_incompletos_nombre) }}</td>
              <td>
                <x-crud routeSee="#modalPedido" :modalSee="$item->id" routeEdit="route('pedido.edit', $item->numero)" />
              </td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
        </tfoot>
      </table>
    </x-blue-board>
  @endif

  @if (count($clientes) > 0)
    <hr class="m-2 m-md-3" />
    <h2 class="m-2 m-md-3">Seguimiento de clientes</h2>
    <div class="m-2 m-md-3 row">
      @foreach ($clientes as $cli)
        @php
          $pedidos_id = App\Models\Produccion\Pedido::where('cliente_id', $cli->id)
              ->whereBetween('fecha_entrada', [date('Y-m-01'), date('Y-m-d')])
              ->pluck('id')
              ->toArray();
          $items = App\Models\Produccion\Pedido_proceso::select('proceso_id', DB::raw('sum(total) as totalData'))
              ->whereIn('pedido_id', $pedidos_id)
              ->groupBy('proceso_id')
              ->get()
              ->each(function ($i) {
                  return $i->nombre = $i->proceso->proceso;
              });
        @endphp
        <x-report :title="$cli->contacto->full_name" :items="$items" />
      @endforeach
    </div>
  @endif
@endsection

@section('modals')
  <x-modal-pedido />
@endsection

@section('scripts')
  <script>
    $('#table').DataTable({
      "paging": true,
      "ordering": true,
      "info": false,
      "responsive": true,
    });
  </script>
@endsection
