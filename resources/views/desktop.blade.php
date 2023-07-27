@extends('layouts.app')

@section('desktop-content')
  <x-path :items="[['text' => session('userInfo.empresa'), 'current' => true, 'href' => '#']]" />

  @include('kpis')

  <div class="row">
    <div class="col-12 col-md-8">
      <div class="m-2 m-md-3">
        <label for="meta">Pedidos por completar: {{ $progreso['incompletos'] }}</label>
        <div class="progress" style="height: 30px;" id="meta">
          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
            style="width: {{ $progreso['progreso'] }}%"
            aria-valuenow='{{ $progreso['pedidos'] - $progreso['incompletos'] }}' aria-valuemin="0"
            aria-valuemax="{{ $progreso['pedidos'] }}">
            {{ $progreso['pedidos'] - $progreso['incompletos'] }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <x-blue-board title='Fecha del reporte' :foot="[]">
        <form action="{{ route('desktop') }}" method="GET" id="fechaForm">
          <div class="form-group">
            {{-- <label for=""></label> --}}
            <input type="date" class="form-control form-control-sm" name="fecha" id="fecha"
              aria-describedby="helpId" value="{{ $fecha }}">
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
    <x-report title="Producción interna" :items="$interna['items']" />
  </div>

  <div class="m-2 m-md-3 row">
    <div class="col-12 col-md-9">
      <canvas id="externa" height="50"></canvas>
    </div>
    <x-report title="Producción externa" :items="$externa['items']" />
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
    <x-report title="Pedidos" :items="$estado['items']" />
  </div>

  <div class="m-2 m-md-3 row">
    <div class="col-12 col-md-9">
      <canvas id="materiales" height="50"></canvas>
    </div>
    <x-report title="Compra de materiales" :items="$material['items']" />
  </div>

  <hr class="m-2 m-md-3" />

  <h2 class="m-2 m-md-3">Utilidad por pedido</h2>
  <div class="m-2 m-md-3">
    <table id="utilidad" class="table table-striped table-sm">
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
          $items = App\Models\Produccion\Pedido_proceso::select('proceso_id', DB::raw('sum(total) as "totalData"'))
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
          $items = App\Models\Produccion\Solicitud_material::select('material_id', DB::raw('sum(total) as "totalData"'))
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

    const interna_labels = @json($interna['labels']);
    const interna_data = @json($interna['data']);
    const interna_ratio = interna_data.length > 0 ? false : true;
    const interna = new Chart($('#interna'), {
      type: 'horizontalBar',
      data: {
        labels: interna_labels,
        datasets: [{
          label: 'Produccion Interna',
          data: interna_data,
          borderWidth: 1
        }]
      },
      options: {
        maintainAspectRatio: interna_ratio,
      }
    });

    const externa_labels = @json($externa['labels']);
    const externa_data = @json($externa['data']);
    const externa_ratio = externa_data.length > 0 ? false : true;
    const externa = new Chart($('#externa'), {
      type: 'horizontalBar',
      data: {
        labels: externa_labels,
        datasets: [{
          label: 'Produccion externa',
          data: externa_data,
          borderWidth: 1
        }]
      },
      options: {
        maintainAspectRatio: externa_ratio,
      }
    });

    const material_labels = @json($material['labels']);
    const material_data = @json($material['data']);
    const materiales = new Chart($('#materiales'), {
      type: 'horizontalBar',
      data: {
        labels: material_labels,
        datasets: [{
          label: 'Solicitud de material',
          data: material_data,
          borderWidth: 1
        }]
      },
      options: {
        maintainAspectRatio: false,
      }
    });

    const pedidos_labels = @json($estado['labels']);
    const pedidos_data = @json($estado['data']);
    const pedidosC = new Chart($('#pedidosC'), {
      type: 'pie',
      data: {
        labels: pedidos_labels,
        datasets: [{
          label: 'Pedidos conteo',
          data: pedidos_data,
          backgroundColor: ['red', 'green', 'blue', 'yellow'],
          borderWidth: 1
        }]
      },
      options: {
        maintainAspectRatio: false,
      }
    });

    const pedidos_data2 = @json($estado['data2']);
    const pedidosD = new Chart($('#pedidosD'), {
      type: 'pie',
      data: {
        labels: pedidos_labels,
        datasets: [{
          label: 'Pedidos ganancia',
          data: pedidos_data2,
          backgroundColor: ['red', 'green', 'blue', 'yellow'],
          borderWidth: 1
        }]
      },
      options: {
        maintainAspectRatio: false,
      }
    });
  </script>
  <script>
    $('#utilidad').DataTable({
      "paging": true,
      "ordering": true,
      "info": false,
      "responsive": true,
    });
  </script>
  @stack('kpis-script')
  @stack('year-pred-script')
@endsection
