<div class="m-2 m-md-3">
  <canvas id="yearly" height="100"></canvas>
</div>

@push('year-pred-script')
  <script>
    const colors = JSON.parse(`@json($colors)`);
    const months = JSON.parse(`@json($months)`);
    const actual = JSON.parse(`@json($actual)`);
    const promedio = JSON.parse(`@json($average)`);
    const yearly_data = JSON.parse(`@json($yearly)`);

    const datasets = [{
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
    ];
    Object.keys(yearly_data).map((year, indx) => {
      datasets.push({
        label: year,
        data: yearly_data[year],
        borderColor: colors[indx],
        borderDash: [5, 5],
        fill: false,
      });
    });

    var yearly = new Chart($('#yearly'), {
      type: 'line',
      data: {
        labels: months,
        datasets: datasets
      },
    });
  </script>
@endpush
