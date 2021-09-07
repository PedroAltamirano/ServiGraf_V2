<div class="m-2 m-md-3">
  {{-- @json($actual)
  @json($average)
  @json($yearly) --}}
  <canvas id="yearly" height="100"></canvas>
</div>

@push('year-pred-script')
  <script>
    var yearly = new Chart($('#yearly'), {
      type: 'line',
      data: {
        labels: @json($months),
        datasets: [
          {
            label: 'Año actual',
            data: @json($actual->map(function($e)use($months){ return ['x' => $months[$e->month-1], 'y' => $e->total];})->toArray()),
            borderColor: '#3b5998',
            fill: false,
          },
          {
            label: 'Promedio',
            data: @json($average->map(function($e)use($months){ return ['x' => $months[$e->month-1], 'y' => $e->total];})->toArray()),
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
