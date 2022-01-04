<section>
  <div class="m-2 m-md-3 row" id="KPIs"></div>
</section>

@push('kpis-script')
  <script>
    const kpis = [
      `{{ route('kpi.facturado') }}`,
      `{{ route('kpi.utilidad') }}`,
      `{{ route('kpi.cobrar') }}`,
      `{{ route('kpi.lob_facturacion') }}`,
      `{{ route('kpi.maquinas') }}`,
      `{{ route('kpi.ots') }}`,
      `{{ route('kpi.lob_ots') }}`,
      `{{ route('kpi.cotizado') }}`,
    ];

    const getKPI = route => {
      let fecha = $('#fecha').val();
      axios.get(route, {
        params: {
          fecha: fecha
        }
      }).then(res => {
        let data = res.data;
        $("#KPIs").append(data);
      }).catch(error => {
        swal('Oops!', 'No hemos podido cargar los KPIs', 'error');
        console.log(error);
      });
    }

    $(() => kpis.forEach(kpi => getKPI(kpi)));
  </script>
@endpush
