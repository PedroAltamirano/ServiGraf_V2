<section>
  <div class="m-2 m-md-3 row" id="KPIs"></div>
</section>

@push('kpis-script')
<script>
  const kpis = [
    "{{ route('kpi.facturado') }}",
    "{{ route('kpi.utilidad') }}",
    "{{ route('kpi.cobrar') }}",
    "{{ route('kpi.lob_facturacion') }}",
    "{{ route('kpi.maquinas') }}",
    "{{ route('kpi.ots') }}",
    "{{ route('kpi.lob_ots') }}"
  ];
  const fecha = $('#fecha').val();

  function getKPI(route){
    axios.get(route, {
      params: {
        fecha : fecha
      }
    }).then(res => {
      let data = res.data;
      $("#KPIs").append(data);
    }).catch(err => {
      swal('Oops!', err, 'error');
      console.log(err);
    });
  }

  $(function(){
    kpis.forEach(kpi => { getKPI(kpi) })
  });
</script>
@endpush
