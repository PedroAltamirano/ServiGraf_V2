@extends('layouts.app')

@section('desktop-content')
  <x-path :items="[ ['text' => session('userInfo.empresa'), 'current' => true, 'href' => '#'] ]" />

  @include('kpis')

  <div class="row">
    <div class="col-12 col-md-8">
      <div class="m-2 m-md-3">
        <label for="meta">Pedidos por completar: {{ $pedidos_incompletos }}</label>
        <div class="progress" style="height: 30px;" id="meta">
          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
            style="width: {{ $progreso }}%" aria-valuenow='{{ $pedidos_terminados - $pedidos_incompletos }}'
            aria-valuemin="0" aria-valuemax="{{ $pedidos_terminados }}">
            {{ $pedidos_terminados - $pedidos_incompletos }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <x-blue-board title='Fecha del reporte' :foot="[]">
        <form action="{{ route('desktop') }}" method="GET" id="fechaForm">
          <div class="form-group">
            {{-- <label for=""></label> --}}
            <input type="date" class="form-control form-control-sm" name="fecha" id="fecha" aria-describedby="helpId"
              value="{{ $fecha }}">
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
      $procesos_internos_array = $procesos
          ->where('tipo', 1)
          ->pluck('id')
          ->toArray();
      $items = App\Models\Produccion\Pedido_proceso::select('proceso_id', DB::raw('sum(total) as totalData'))
          ->whereIn('pedido_id', $pedidos_array)
          ->whereIn('proceso_id', $procesos_internos_array)
          ->with('proceso')
          ->groupBy('proceso_id')
          ->get()
          ->each(function ($i) {
              return $i->nombre = $i->proceso->proceso;
          });
      // Para JSON chart
      $Id = $items->pluck('totalData');
      $Il = $items->pluck('nombre');
    @endphp
    <x-report title="Producción interna" :items="$items" />
  </div>


  <div class="m-2 m-md-3 row">
    <div class="col-12 col-md-9">
      <canvas id="externa" height="50"></canvas>
    </div>
    @php
      $procesos_externos_array = $procesos
          ->where('tipo', 0)
          ->pluck('id')
          ->toArray();
      $items = App\Models\Produccion\Pedido_proceso::select('proceso_id', DB::raw('sum(total) as totalData'))
          ->whereIn('pedido_id', $pedidos_array)
          ->whereIn('proceso_id', $procesos_externos_array)
          ->with('proceso')
          ->groupBy('proceso_id')
          ->get()
          ->each(function ($i) {
              return $i->nombre = $i->proceso->proceso;
          });
      // Para JSON chart
      $Ed = $items->pluck('totalData');
      $El = $items->pluck('nombre');
    @endphp
    <x-report title="Producción externa" :items="$items" />
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
      $pedidos_pendientes = $pedidos->where('estado', 1);
      $pendientes = new Stdclass();
      $pendientes->nombre = 'Pendientes';
      $pendientes->totalData = $pedidos_pendientes->count();
      $pendientes->economic = $pedidos_pendientes->sum('total_pedido');

      $pedidos_pagadas = $pedidos->where('estado', 2);
      $pagadas = new Stdclass();
      $pagadas->nombre = 'Pagadas';
      $pagadas->totalData = $pedidos_pagadas->count();
      $pagadas->economic = $pedidos_pagadas->sum('total_pedido');

      $pedidos_anuladas = $pedidos->where('estado', 3);
      $anuladas = new Stdclass();
      $anuladas->nombre = 'Anuladas';
      $anuladas->totalData = $pedidos_anuladas->count();
      $anuladas->economic = $pedidos_anuladas->sum('total_pedido');

      $pedidos_canjes = $pedidos->where('estado', 4);
      $canjes = new Stdclass();
      $canjes->nombre = 'Canje';
      $canjes->totalData = $pedidos_canjes->count();
      $canjes->economic = $pedidos_canjes->sum('total_pedido');

      $items = collect([$pendientes, $pagadas, $anuladas, $canjes]);
      // Para JSON chart
      $PCd = $items->pluck('totalData');
      $PDd = $items->pluck('economic');
      $Pl = $items->pluck('nombre');
    @endphp
    <x-report title="Pedidos" :items="$items" />
  </div>


  <div class="m-2 m-md-3 row">
    <div class="col-12 col-md-9">
      <canvas id="materiales" height="50"></canvas>
    </div>
    @php
      $items = App\Models\Produccion\Solicitud_material::select('material_id', DB::raw('sum(total) as totalData'))
          ->whereIn('pedido_id', $pedidos_array)
          ->with('material')
          ->groupBy('material_id')
          ->get()
          ->each(function ($i) {
              return $i->nombre = $i->material->descripcion;
          });
      $Md = $items->pluck('totalData');
      $Ml = $items->pluck('nombre');
    @endphp
    <x-report title="Compra de materiales" :items="$items" />
  </div>


  <hr class="m-2 m-md-3" />
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
        @foreach ($utilidades as $item)
          <tr>
            <td>{{ $item->numero }}</td>
            <td>{{ $item->cliente->full_name }}</td>
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

  <hr class="m-2 m-md-3" />
  <h2 class="m-2 m-md-3">Seguimiento de clientes</h2>
  @if (count($clientes) > 0)
    <div class="m-2 m-md-3 row">
      @foreach ($clientes as $cli)
        @php
          $pedidos_id = $pedidos
              ->where('cliente_id', $cli->id)
              ->pluck('id')
              ->toArray();
          $items = App\Models\Produccion\Pedido_proceso::select('proceso_id', DB::raw('sum(total) as totalData'))
              ->whereIn('pedido_id', $pedidos_id)
              ->with('proceso')
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

  <hr class="m-2 m-md-3" />
  <h2 class="m-2 m-md-3">Compra de material</h2>
  @if (count($clientes) > 0)
    <div class="m-2 m-md-3 row">
      @foreach ($clientes as $cli)
        @php
          $pedidos_array = $pedidos
              ->where('cliente_id', $cli->id)
              ->pluck('id')
              ->toArray();
          $items = App\Models\Produccion\Solicitud_material::select('material_id', DB::raw('sum(total) as totalData'))
              ->whereIn('pedido_id', $pedidos_array)
              ->with('material')
              ->groupBy('material_id')
              ->get()
              ->each(function ($i) {
                  return $i->nombre = $i->material->descripcion;
              });
        @endphp
        <x-report :title="$cli->contacto->full_name" :items="$items" />
      @endforeach
    </div>
  @endif

  <hr class="m-2 m-md-3" />
  <h2 class="m-2 m-md-3">Predicción Anual</h2>
  <x-year-pred />

@endsection

@section('scripts')
  <script>
    $('#fecha').change(() => $('#fechaForm').submit());

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
          backgroundColor: ['red', 'green', 'blue', 'yellow'],
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
          backgroundColor: ['red', 'green', 'blue', 'yellow'],
          borderWidth: 1
        }]
      },
    });
  </script>
  @stack('kpis-script')
  @stack('year-pred-script')
@endsection
