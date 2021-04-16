<section>
  <div class="m-2 m-md-3 row" id="KPIs"></div>
</section>

@push('kpis-script')
<script>
  const kpis = ["{{ route('kpi.facturado') }}", "{{ route('kpi.utilidad') }}", "{{ route('kpi.cobrar') }}", "{{ route('kpi.lob_facturacion') }}", "{{ route('kpi.maquinas') }}", "{{ route('kpi.ots') }}", "{{ route('kpi.lob_ots') }}"];
  const fecha = $('#fecha').val();

  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
  });

  function getKPI(route){
    $.ajax({
      url: route,
      type: "get",
      dataType: "html",
      data: {
        'fecha' : fecha
      },
      success: function success(data) {
        $("#KPIs").append(data);
      },
      error: function error(jqXhr, textStatus, errorThrown) {
        console.log(errorThrown);
      }
    });
  }

  $(function(){
    kpis.forEach((kpi)=>{getKPI(kpi)})
  });
</script>
@endpush
