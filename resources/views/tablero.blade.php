@extends('layouts.app')

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => session('userInfo.nomina'),
      'current' => true,
      'href' => '#',
    ]
  ]"
/>

@if(count($procesos) > 0)
  @php
   $colors = ['bg-success', 'bg-info', 'bg-warning', 'bg-danger'];
  @endphp
  @foreach ($procesos as $item)
  @php
    $logrado = App\Models\Produccion\Pedido_servicio::where('status', 1)->whereBetween('created_at', [date('Y-m-01'), date('Y-m-d')])->where('servicio_id', $item->id)->sum('total');
    $prog = ($logrado * 100) / $item->meta;
    $ci = $loop->index % count($colors);
  @endphp
  <div class="m-2 m-md-3">
    <label for="meta">Producción {{ $item->servicio }} ${{ $item->meta }}</label>
    <div class="progress" style="height: 30px;" id="meta">
      <div class="progress-bar progress-bar-striped progress-bar-animated {{ $colors[$ci] }}" role="progressbar" style="width: {{$prog}}%" aria-valuenow="{{ $logrado }}" aria-valuemin="0" aria-valuemax="{{ $item->meta }}">{{ $logrado }}</div>
    </div>
  </div>
  @endforeach
@endif

@if(count($procesos) > 0)
<x-blueBoard
  title='Pendientes'
  :foot="[
    ['text'=>'Nuevo', 'href'=>route('pedido.create'), 'id'=>'nuevo', 'tipo'=> 'link'],
  ]"
>
  <table id="table" class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">Numero</th>
        <th scope="col">Cliente</th>
        <th scope="col" style="width: 25%">Detalle</th>
        <th scope="col">Cant</th>
        <th scope="col" style="width: 40%">Procesos</th>
        <th scope="col" class="crudCol">Crud</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pedidos as $item)
      @php
        $cli = $item->cliente;
        $cli = $cli->empresa->nombre.' / '.$cli->contacto->nombre.' '.$cli->contacto->apellido;
      @endphp
      <tr>
        <td>{{ $item->numero }}</td>
        <td>{{ $cli }}</td>
        <td>{{ $item->detalle }}</td>
        <td>{{ $item->cantidad }}</td>
        <td>{{ implode(', ', $item->serviciosIncompletos($item->id)) }}</td>
        <td><a class='fa fa-edit' href='{{route('pedido.edit', $item->numero)}}'></a> <a class='fa fa-eye verPedido' id="{{ $item->numero }}" href="#modalPedido" data-toggle="modal"></a></td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
    </tfoot>
  </table>
</x-blueBoard>

<x-modal-pedido></x-modal-pedido>
@endif

@if(count($clientes) > 0)
<div class="m-2 m-md-3 row">
  @foreach ($clientes as $cli)
    @php
    $pa = App\Models\Produccion\Pedido::select('id')->where('cliente_id', $cli->id)->whereBetween('fecha_entrada', [date('Y-m-01'), date('Y-m-d')])->get()->map(function($p){return $p->id;})->toArray();
    $items = App\Models\Produccion\Pedido_servicio::select('servicio_id', DB::raw('sum(total) as totalData'))->whereIn('pedido_id', $pa)->groupBy('servicio_id')->get()->each(function($i){return $i->nombre = $i->servicio->servicio; });
    @endphp
    <x-report :title="$cli->contacto->nombre.' '.$cli->contacto->apellido" :items="$items"></x-report>
  @endforeach
</div>
@endif

@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    $('#table').DataTable({
      "paging":   true,
      "ordering": true,
      "info":     false,
      "responsive": true,
    });
  });
</script>
@endsection
