@extends('layouts.app')

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => session('userInfo.empresa'),
      'current' => true,
      'href' => '#',
    ]
  ]"
/>

@include('kpis')

<div class="row">
  <div class="col-12 col-md-8">
    <div class="m-2 m-md-3">
      <label for="meta">Pedidos por completar: {{ $pi }}</label>
      <div class="progress" style="height: 30px;" id="meta">
        @php
          $w = $pt > 0 ?(abs($pt-$pi)*100)/$pt : 0;
        @endphp
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $w }}%" aria-valuenow="{{ $pt-$pi }}" aria-valuemin="0" aria-valuemax="{{ $pt }}">{{ $pt-$pi }}</div>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-4">
    <x-blue-board
      title='Fecha del reporte'
      :foot="[]"
    >
      <form action="{{ route('desktop') }}" method="GET" id="fechaForm">
        <div class="form-group">
          {{-- <label for=""></label> --}}
          <input type="date"
            class="form-control form-control-sm" name="fecha" id="fecha" aria-describedby="helpId" value="{{ $fecha }}">
          <small id="helpId" class="form-text text-muted">Se tomara el mes y año de la fecha seleccionada</small>
        </div>
      </form>
    </x-blue-board>
  </div>
</div>

<h2 class="m-2 m-md-3">Produccion</h2>

<div class="m-2 m-md-3 row">
  <div class="col-12 col-md-9">
    <canvas id="interna" height="50"></canvas>
  </div>
  @php
  $pa = $pedidos->map(function($p){return $p->id;})->toArray();
  $sa = $procesos->where('tipo', 1)->pluck('id')->toArray();
  $items = App\Models\Produccion\Pedido_proceso::select('proceso_id', DB::raw('sum(total) as totalData'))->whereIn('pedido_id', $pa)->whereIn('proceso_id', $sa)->groupBy('proceso_id')->get()->each(function($i){return $i->nombre = $i->proceso; });
  $Id = $items->pluck('totalData');
  $Il = $items->pluck('nombre');
  @endphp
  <x-report title="Producción interna" :items="$items"></x-report>
</div>


<div class="m-2 m-md-3 row">
  <div class="col-12 col-md-9">
    <canvas id="externa" height="50"></canvas>
  </div>
  @php
  $pa = $pedidos->map(function($p){return $p->id;})->toArray();
  $sa = $procesos->where('tipo', 0)->pluck('id')->toArray();
  $items = App\Models\Produccion\Pedido_proceso::select('proceso_id', DB::raw('sum(total) as totalData'))->whereIn('pedido_id', $pa)->whereIn('proceso_id', $sa)->groupBy('proceso_id')->get()->each(function($i){return $i->nombre = $i->proceso->proceso; });
  $Ed = $items->pluck('totalData');
  $El = $items->pluck('nombre');
  @endphp
  <x-report title="Producción interna" :items="$items"></x-report>
</div>


<div class="m-2 m-md-3 row">
  <div class="col-12 col-md-9">
    <div class="row">
      <div class="col-12 col-md-6">
        <canvas id="pedidosC" height="100"></canvas>
      </div>
      <div class="col-12 col-md-6">
        <canvas id="pedidosD" height="100"></canvas>
      </div>
    </div>
  </div>
  @php
  $pendientes = new Stdclass;
  $pendientes->nombre = "Pendientes";
  $pendientes->totalData = count($pedidos->where('estado', 1));
  $pendientes->economic = $pedidos->where('estado', 1)->sum('total_pedido');
  $pagadas = new Stdclass;
  $pagadas->nombre = "Pagadas";
  $pagadas->totalData = count($pedidos->where('estado', 2));
  $pagadas->economic = $pedidos->where('estado', 2)->sum('total_pedido');
  $anuladas = new Stdclass;
  $anuladas->nombre = "Anuladas";
  $anuladas->totalData = count($pedidos->where('estado', 3));
  $anuladas->economic = $pedidos->where('estado', 3)->sum('total_pedido');
  $canjes = new Stdclass;
  $canjes->nombre = "Canje";
  $canjes->totalData = count($pedidos->where('estado', 4));
  $canjes->economic = $pedidos->where('estado', 4)->sum('total_pedido');
  $items = collect([$pendientes, $pagadas, $anuladas, $canjes]);
  $PCd = $items->pluck('totalData');
  $PDd = $items->pluck('economic');
  $Pl = $items->pluck('nombre');
  @endphp
  <x-report title="Pedidos" :items="$items"></x-report>
</div>


<div class="m-2 m-md-3 row">
  <div class="col-12 col-md-9">
    <canvas id="materiales" height="50"></canvas>
  </div>
  @php
  $pa = $pedidos->map(function($p){return $p->id;})->toArray();
  $items = App\Models\Produccion\Solicitud_material::select('material_id', DB::raw('sum(total) as totalData'))->whereIn('pedido_id', $pa)->groupBy('material_id')->get()->each(function($i){return $i->nombre = $i->material->descripcion; });
  $Md = $items->pluck('totalData');
  $Ml = $items->pluck('nombre');
  @endphp
  <x-report title="Compra de materiales" :items="$items"></x-report>
</div>


<hr class="m-2 m-md-3"/>
<h2 class="m-2 m-md-3">Utilidad por pedido</h2>
<div class="m-2 m-md-3">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>Numero</th>
        <th>Cliente</th>
        <th>Detalle</th>
        <th>Utilidad</th>
      </tr>
    </thead>
    <tbody>
      @php
          $utilidades = $pedidos->where('cotizado', '>', 0)->each(function($u){ $u->utilidad = $u->cotizado - $u->total_pedido; });
      @endphp
      @foreach ($utilidades as $item)
      <tr>
        <td>{{ $item->numero }}</td>
        <td>{{ $item->cliente->contacto->nombre.' '.$item->cliente->contacto->apellido }}</td>
        <td>{{ $item->detalle }}</td>
        <td class="text-right">{{ number_format($item->utilidad, 2) }}</td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr class="text-right">
        <td colspan="3">Total $</td>
        <td>{{ number_format($utilidades->sum('utilidad'), 2) }}</td>
      </tr>
    </tfoot>
  </table>
</div>

<hr class="m-2 m-md-3"/>
<h2 class="m-2 m-md-3">Seguimiento de clientes</h2>
@if(count($clientes) > 0)
<div class="m-2 m-md-3 row">
  @foreach ($clientes as $cli)
    @php
    $pa = $pedidos->where('cliente_id', $cli->id)->map(function($p){return $p->id;})->toArray();
    $items = App\Models\Produccion\Pedido_proceso::select('proceso_id', DB::raw('sum(total) as totalData'))->whereIn('pedido_id', $pa)->groupBy('proceso_id')->get()->each(function($i){return $i->nombre = $i->proceso->proceso; });
    @endphp
    <x-report :title="$cli->contacto->nombre.' '.$cli->contacto->apellido" :items="$items"></x-report>
  @endforeach
</div>
@endif

<hr class="m-2 m-md-3"/>
<h2 class="m-2 m-md-3">Compra de material</h2>
@if(count($clientes) > 0)
<div class="m-2 m-md-3 row">
  @foreach ($clientes as $cli)
    @php
    $pa = $pedidos->where('cliente_id', $cli->id)->map(function($p){return $p->id;})->toArray();
    $items = App\Models\Produccion\Solicitud_material::select('material_id', DB::raw('sum(total) as totalData'))->whereIn('pedido_id', $pa)->groupBy('material_id')->get()->each(function($i){return $i->nombre = $i->material->descripcion; });
    @endphp
    <x-report :title="$cli->contacto->nombre.' '.$cli->contacto->apellido" :items="$items"></x-report>
  @endforeach
</div>
@endif

<hr class="m-2 m-md-3"/>
<h2 class="m-2 m-md-3">Predicción Anual</h2>
<x-year-pred />

@endsection

@section('scripts')
<script>
  $('#fecha').on('change', function(){
    $('#fechaForm').submit();
  });
</script>
<script>
  var interna = new Chart($('#interna'), {
    type: 'horizontalBar',
    data: {
      labels: @json($Il),
      datasets: [{
        label: 'Produccion Interna',
        data: @json($Id),
        borderWidth: 1
      }]
    },
  });

  var externa = new Chart($('#externa'), {
    type: 'horizontalBar',
    data: {
      labels: @json($El),
      datasets: [{
        label: 'Produccion externa',
        data: @json($Ed),
        borderWidth: 1
      }]
    },
  });

  var materiales = new Chart($('#materiales'), {
    type: 'horizontalBar',
    data: {
      labels: @json($Ml),
      datasets: [{
        label: 'Solicitud de material',
        data: @json($Md),
        borderWidth: 1
      }]
    },
  });

  var pedidosC = new Chart($('#pedidosC'), {
    type: 'pie',
    data: {
      labels: @json($Pl),
      datasets: [{
        label: 'Pedidos conteo',
        data: @json($PCd),
        backgroundColor: [ 'red', 'green', 'blue', 'yellow'],
        borderWidth: 1
      }]
    },
  });

  var pedidosD = new Chart($('#pedidosD'), {
    type: 'pie',
    data: {
      labels: @json($Pl),
      datasets: [{
        label: 'Pedidos ganancia',
        data: @json($PDd),
        backgroundColor: [ 'red', 'green', 'blue', 'yellow'],
        borderWidth: 1
      }]
    },
  });
</script>
@stack('kpis-script')
@stack('year-pred-script')
@endsection
