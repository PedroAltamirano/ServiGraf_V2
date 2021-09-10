<div class="m-2 m-md-3">
  {{-- @json($actual)
  @json($average)
  @json($yearly) --}}
  <canvas id="yearly" height="100"></canvas>
  @php
    $actual = $actual->map(function($e)use($months){ return ['x' => $months[$e->month-1], 'y' => $e->total];})->toArray();
    $promedio = $average->map(function($e)use($months){ return ['x' => $months[$e->month-1], 'y' => $e->total];})->toArray();
  @endphp
</div>

@push('year-pred-script')
  <script>
    const months = `@json($months)`;
    const actual = `@json($actual)`;
    const promedio = `@json($promedio)`;

    var yearly = new Chart($('#yearly'), {
      type: 'line',
      data: {
        labels: months,
        datasets: [
          {
            label: 'Año actual',
            data: actual,
            borderColor: '#3b5998',
            fill: false,
          },
          {
            label: 'Promedio',
            data: promedio,
            borderDash: [5, 5],
            fill: false,
          },
          @foreach ($yearly as $key => $year)
            {
              label: '{{ $key }}',
              data: @json($year->map(function($e)use($months){ return ['x' => $months[$e->month-1], 'y' => $e->total];})->toArray()),
              borderColor: '{{ $colors[$loop->index] }}',
              borderDash: [5, 5],
              fill: false,
            },
          @endforeach
        ]
      },
    });
  </script>
@endpush
