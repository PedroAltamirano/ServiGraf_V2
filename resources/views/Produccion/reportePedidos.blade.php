@extends('layouts.app')

@section('links')
@endsection

@section('desktop-content')
<path-route
  :items="[
    {
      text: 'Pedidos',
      current: false,
      href: '{{route("pedidos")}}',
    },
    {
      text: 'Reporte de pedidos',
      current: true,
      href: '#',
    }
  ]"
></path-route>

<blue-board
  title='Filtros'
  :foot="[]"
>
  <div class="form-row">
    <div class="col-6 col-md form-group">
      <label for="inicio">Fecha inicial</label>
      <input type="date" name="inicio" id="inicio" class="form-control form-control-sm" value="{{date('Y-m-').'01'}}">
    </div>
    <div class="col-6 col-md form-group">
      <label for="fin">Fecha final</label>
      <input type="date" name="fin" id="fin" class="form-control form-control-sm" value="{{date('Y-m-d')}}">
    </div>
    <div class="col-12 col-md form-group">
      <label for="cliente">Cliente</label>
      <select name="cliente" id="cliente" class="form-control">
        <option disabled selected>Selecciona uno...</option>
        {{ $group =  $clientes->first()->cliente_empresa_id }}
        <optgroup label="{{ $clientes->first()->empresa->nombre }}">
        @foreach ($clientes as $cli)
          @if ($group != $cli->cliente_empresa_id)
          {{ $group =  $cli->cliente_empresa_id }}
          <optgroup label="{{ $cli->empresa->nombre }}">
          @endif
          <option value="{{ $cli->id }}">
            {{ $cli->contacto->nombre.' '.$cli->contacto->apellido }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="col-6 col-md form-group">
      <label for="cobro">Cobro</label>
      <select class="form-control form-control-sm" name="cobro" id="cobro">
        <option value="0">Todo</option>
        <option value="1">Pagado</option>
        <option value="2">No pagado</option>
        <option value="3">Canje</option>
      </select>
    </div>
    <div class="col-1 text-center">
      <button type="button" name="refresh" id="refresh" class="btn btn-primary mt-3"><i class="fas fa-sync-alt"></i></button>
      {{-- <button type="button" class="btn btn-outline-primary"><i class="fas fa-sync-alt"></i></button> --}}
    </div>
  </div>
</blue-board>

<blue-board
  title='Pendientes'
  :foot="[
    {text:'fas fa-print', href:'imprimir(\'tabla\')', id:'print', tipo: 'button'},
  ]"
>
  <table id="table" class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Cliente</th>
        <th scope="col">Detalle</th>
        @foreach ($areas as $area)
        <th scope="col">{{$area->area}}</th>
        @endforeach
        <th scope="col">Total $</th>
        <th scope="col">Abonos $</th>
        <th scope="col">Saldo $</th>
        <th scope="col">Estado</th>
        <th scope="col" class="crudCol">Crud</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    </tfoot>
  </table>
</blue-board>
@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    let areas = @json($areas);
    // console.log(areas.length);
    $('#table').DataTable({
      "paging":   true,
      "ordering": true,
      "info":     false,
      "ajax": {
        "url": "{{route('reporte.pedidos.ajax')}}",
        "method": 'get',
        // "data": {
        //   "fechaini": $('#fechaini').val(),
        //   "fechafin": $('#fechafin').val(),
        //   "cliente": $('#cliente').val(),
        //   "cobro": $('#cobro').val()
        // },
        "success": function(data){
          console.log(data);
        },
        "error": function(reason) {
          alert('Ha ocurrido un error al cargar los datos!');
          console.log('error -> ');
          console.log(reason);
        }
      },
      "columns": [
        {"name":"numero", "data": "numero"},
        {"name":"cliente", "data": "cliente_id"},
        {"name":"detalle", "data": "detalle"},
        // @for($i=0; $i<sizeof($areas); $i++)
        {"name":"area", "data":"areas[0].totalArea", "defaultContent": ""},
        {"name":"area", "data":"areas[1].totalArea", "defaultContent": ""},
        // @endfor
        {"name":"total", "data": "total_pedido"},
        {"name":"abonos", "data": "abono"},
        {"name":"saldo", "data": "saldo"},
        {"name":"estado", "data": "estado",
                  // "render": function ( data, type, full, meta ) { 
                  //   var rspt;
                  //   if(data == '1') rspt = "<em class='fa fa-check'></em>";
                  //   else if(data == '2') rspt = "<em class='fa fa-times'></em>";
                  //   else if(data == '3') rspt = "<em class='fa fa-trash-alt'></em>";
                  //   else if(data == '4') rspt = "<em class='fa fa-exchange'></em>";
                  //   else rspt = "<em class='fa fa-ban'></em>";
                  //   return rspt;
                  // },
                "sortable": "false"
        },
        {"name":"crud", "data":"id", "sortable": "false",
          // "render": function ( data, type, full, meta ) {
          //   return "<a class='fa fa-edit' href='ot/modificar/"+data+"'></a> <a class='fa fa-eye' href='#' onClick='openOt("+data+")'></a>"
          // }
        }
      ],
      "columnDefs": [
        // { "responsivePriority": 1, "targets": [0, 1, -1] }
      ],
      // responsive: true,
    });
  });
</script>
@endsection

@section('document.ready')
$('#cliente').select2();
@endsection