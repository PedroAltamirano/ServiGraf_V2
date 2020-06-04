@php
  $proveedores = App\Models\Produccion\Proveedor::where('empresa_id', Auth::user()->empresa_id)->get();
  $materiales = App\Models\Produccion\Material::where('empresa_id', Auth::user()->empresa_id)->orderBy('categoria_id')->get();
  $servicios = App\Models\Produccion\Servicio::where('empresa_id', Auth::user()->empresa_id)->orderBy('area_id')->get();
@endphp

<section id="descripcion">
  <div class="form-row">
    <div class="form-group col-12 col-md-6">
      <div class="form-group">
        <label for="descripcion"><b>Descripcion del trabajo</b></label>
        <textarea class="form-control form-control-sm" name="descripcion" id="descripcion" rows="1"></textarea>
      </div>
    </div>
    <div class="form-group col-8 col-md-4">
      <label for="papel">Papel</label>
      <input type="text" name="papel" id="papel" class="form-control form-control-sm" placeholder="">
    </div>
    <div class="form-group col-4 col-md-2">
      <label for="cantidad">Cantidad</label>
      <input type="number" name="cantidad" id="cantidad" class="form-control form-control-sm" value="0">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-6 col-md-3 order-1">
      <label for="corte">Corte Final</label>
      <div class="form-row" id="corte">
        <div class="col-6">
          <input type="number" name="corte_ancho" id="corte_ancho" class="form-control form-control-sm" value="0.00" aria-describedby="help_corte_ancho">
          <small id="help_corte_ancho" class="text-muted">Ancho</small>
        </div>
        <div class="col-6">
          <input type="number" name="corte_alto" id="corte_alto" class="form-control form-control-sm" value="0.00" aria-describedby="help_corte_alto">
          <small id="help_corte_alto" class="text-muted">Alto</small>
        </div>
      </div>
    </div>
    <div class="form-group col-12 col-md-5 order-3 order-md-2">
      <label for="tintas">Tintas</label>
      <div class="form-row" id="tintas">
        <div class="col-6">
          <select name="tinta_tiro" id="tinta_tiro" class="form-control form-control-sm" aria-describedby="help_tintas_tiro" multiple>
            <option value="">1</option>
            <option value="">2</option>
            <option value="">3</option>
          </select>
          <small id="help_tintas_tiro" class="text-muted">Tiro</small>
        </div>
        <div class="col-6">
          <select name="tinta_retiro" id="tinta_retiro" class="form-control form-control-sm" aria-describedby="help_tintas_retiro" multiple></select>
          <small id="help_tintas_retiro" class="text-muted">Retiro</small>
        </div>
      </div>
    </div>
    <div class="form-group col-6 col-md-4 order-2 order-md-3">
      <label for="numerado">Numerado</label>
      <div class="form-row" id="numerado">
        <div class="col-6">
          <input type="number" name="numerado_inicio" id="numerado_inicio" class="form-control form-control-sm" value="0.00" aria-describedby="help_numerado_inicio">
          <small id="help_numerado_inicio" class="text-muted">Inicial</small>
        </div>
        <div class="col-6">
          <input type="number" name="numerado_fin" id="numerado_fin" class="form-control form-control-sm" value="0.00" aria-describedby="help_numerado_fin">
          <small id="help_numreado_fin" class="text-muted">Final</small>
        </div>
      </div>
    </div>
  </div>
</section>

<hr style="border-width: 3px;">

<section id="material">
  <table id="table-materiales" class="table table-sm table-responsive">
    <thead>
      <tr>
        <th scope="col" class="crudCol"><i id="addMaterial" class="fas fa-plus"></i></th>
        <th scope="col" style="width: 30%"><b>Solicitud de material</b></th>
        <th scope="col" class="text-center">Cantidad</th>
        <th scope="col" colspan="2" class="text-center">Corte</th>
        <th scope="col" class="text-center">Tamaños</th>
        <th scope="col" style="width: 20%"><i onclick="alert('proveedor')" class="fas fa-plus"></i> Proveedor</th>
        <th scope="col" class="text-center">Factura</th>
        <th scope="col" class="text-center">Total</th>
      </tr>
    </thead>
    <tbody>
      {{-- <tr id="row-material-0">
        <td>
          <i type="button" name="remove" id="material-0" class="fas fa-times removeRow"></i>
        </td>
        <td>
          <select class="form-control form-control-sm selectMaterial" name="material[]">
            <option selected disabled>Seleccione uno...</option>
            {{ $group =  $materiales->first()->categoria_id }}
            <optgroup label="{{ $materiales->first()->categoria->categoria }}">
            @foreach($materiales as $mat)
            @if ($group != $mat->categoria_id)
            {{ $group =  $mat->categoria_id }}
            <optgroup label="{{ $mat->categoria->categoria }}">
            @endif
            <option value="{{ $mat->id }}">{{ $mat->descripcion }}</option>
            @endforeach
          </select>
        </td>
        <td>
          <input type="number" name="cantidad[]" class="form-control form-control-sm text-center" value="0" min="0" />
        </td>
        <td>
          <input type="number" name="corte_alt[]" class="form-control form-control-sm fixFloat text-center" value="0.00" step="0.01" min="0" />
        </td>
        <td>
          <input type="number" name="corte_anc[]" class="form-control form-control-sm fixFloat text-center" value="0.00" step="0.01" min="0" />
        </td>
        <td>
          <input type="number" name="tamanios[]" class="form-control form-control-sm text-center" value="0" min="0" />
        </td>
        <td>
          <select class="form-control form-control-sm selectProveedor" name="proveedor[]">
            <option selected disabled>Seleccione uno...</option>
            @foreach($proveedores as $prov)
            <option value="{{ $prov->id }}">{{ $prov->proveedor }} / {{ $prov->telefono }}</option>
            @endforeach
          </select>
        </td>
        <td>
          <input type="number" name="factura[]" class="form-control form-control-sm text-center" min="0" />
        </td>
        <td>
          <input type="number" name="material_total[]" class="form-control form-control-sm fixFloat text-center" value="0.00" step="0.01" min="0" onchange="sumarPedidos()" />
        </td>
      </tr> --}}
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2"><a class="text-muted" href="#">Corte de papel</a></td>
        <td colspan="4" class="text-right"></td>
        <td colspan="2" class="text-right"><i class="fas fa-print pr-2"></i>  <b>Total material $</b></td>
        <td class="text-center"><b id="totalMaterial">0.00</b></td>
      </tr>
    </tfoot>
  </table>
</section>

<hr style="border-width: 3px;">

<section id="procesos">
  <table id="table-procesos" class="table table-sm">
    <thead>
      <tr>
        <th scope="col" class="crudCol"><i onclick="addProceso()" class="fas fa-plus"></i></th>
        <th scope="col" style="width: 50%"><b>Procesos</b></th>
        <th scope="col" class="text-center">T</th>
        <th scope="col" class="text-center">R</th>
        <th scope="col" class="text-center">Mill</th>
        <th scope="col" class="text-center">Valor Unitario</th>
        <th scope="col" class="text-center">Total</th>
        <th scope="col" class="crudCol"><i class="fas fa-check" id="checkall"></i></th>
      </tr>
    </thead>
    <tbody>
      <tr id="row-proceso-0">
        <td>
          <i type="button" name="remove" id="proceso-0" class="fas fa-times removeRow"></i>
        </td>
        <td>
          <select class="form-control form-control-sm selectProceso" name="proceso[]">
            <option selected disabled>Seleccione uno...</option>
            {{ $group =  $servicios->first()->area_id }}
            <optgroup label="{{ $servicios->first()->area->area }}">
            @foreach($servicios as $serv)
              @if ($group != $serv->area_id)
              {{ $group = $serv->area_id }}
              </optgroup>
              <optgroup label="{{ $serv->area->area }}">
              @endif
              @if ($serv->subprocesos == 0)
              <option value="{{ $serv->id }}">{{ $serv->servicio }}</option>
              @else
              <option disabled>{{ $serv->servicio }}</option>
                {{ $subservicios = $serv->subservicios }}
                @foreach($subservicios as $sub)
                <option value="{{ $serv->id.'-'.$sub->id }}">&nbsp;&nbsp;&nbsp;&nbsp;{{ $sub->subservicio }}</option>
                @endforeach
              @endif
            @endforeach
            </optgroup>
          </select>
        </td>
        <td>
          <input type="number" name="tiro[]" id="tiro-0" class="form-control form-control-sm text-center" value="1" min="0" onchange="sumar('0')" />
        </td>
        <td>
          <input type="number" name="retiro[]" id="retiro-0" class="form-control form-control-sm text-center" value="0" min="0" onchange="sumar('0')" />
        </td>
        <td>
          <input type="number" name="millar[]" id="mill-0" class="form-control form-control-sm text-center" value="1" min="0" onchange="sumar('0')" />
        </td>
        <td>
          <input type="number" name="valor[]" id="valor-0" class="form-control form-control-sm fixFloat text-center" value="0.00" step="0.01" min="0" onchange="sumar('0')" />
        </td>
        <td>
          <input type="number" name="total_proceso[]" id="total_proceso-0" class="form-control form-control-sm text-center" value="0.00" step="0.01" min="0" readonly />
        </td>
        <td>
          <input type="checkbox" name="terminado[]" />
        </td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4"></td>
        <td colspan="2" class="text-right"><b>Total Pedido $</b></td>
        <td class="text-center"><b id="totalProcesos">0.00</b></td>
        <td></td>
      </tr>
      <tr>
        <td colspan="4"></td>
        <td colspan="2" class="text-right">Abonos $</td>
        <td class="text-center">0.00</td>
        <td><i class="fas fa-eye"></i></td>
      </tr>
      <tr>
        <td colspan="4"></td>
        <td colspan="2" class="text-right">Saldo $</td>
        <td class="text-center">0.00</td>
        <td></td>
      </tr>
    </tfoot>
  </table>
</section>

@section('after.document.ready')
$('#tinta_tiro').select2({
  maximumSelectionLength: 4,
});

$('#tinta_retiro').select2({
  maximumSelectionLength: 4,
});

$('.selectMaterial').select2({
});

$('.selectProveedor').select2({
});
@endsection

@section('after.after.scripts')
<script>
  //SOLICITUD DE MATERIALES
  $(function(){
    var i = 0;
    $('#addMaterial').click(function(){
      i++;
      $('#table-materiales > tbody').append('<tr id="row-material-'+i+'">'+
        '<td><i type="button" name="remove" id="material-'+i+'" class="fas fa-times removeRow"></i></td>'+
        '<td><select class="form-control form-control-sm selectMaterial" name="material[]"><option selected disabled>Seleccione uno...</option>{{ $group =  $materiales->first()->categoria_id }}<optgroup label="{{ $materiales->first()->categoria->categoria }}">@foreach($materiales as $mat)@if ($group != $mat->categoria_id){{ $group =  $mat->categoria_id }}<optgroup label="{{ $mat->categoria->categoria }}">@endif<option value="{{ $mat->id }}">{{ $mat->descripcion }}</option>@endforeach</select></td>'+
        '<td><input type="number" name="cantidad[]" class="form-control form-control-sm text-center" value="0" min="0" /></td>'+
        '<td><input type="number" name="corte_alt[]" class="form-control form-control-sm fixFloat text-center" value="0.00" step="0.01" min="0" /></td>'+
        '<td><input type="number" name="corte_anc[]" class="form-control form-control-sm fixFloat text-center" value="0.00" step="0.01" min="0" /></td>'+
        '<td><input type="number" name="tamanios[]" class="form-control form-control-sm text-center" value="0" min="0" /></td>'+
        '<td><select class="form-control form-control-sm selectProveedor" name="proveedor[]"><option selected disabled>Seleccione uno...</option>@foreach($proveedores as $prov)<option value="{{ $prov->id }}">{{ $prov->proveedor }} / {{ $prov->telefono }}</option>@endforeach</select></td>'+
        '<td><input type="number" name="factura[]" class="form-control form-control-sm text-center" min="0" /></td>'+
        '<td><input type="number" name="material_total[]" class="form-control form-control-sm fixFloat text-center" value="0.00" step="0.01" min="0" onchange="sumarMaterial()" /></td>'+
      '</tr>');
    });
  });

  //sumar total pedidos
  function sumarMaterial(){
    let total = 0.00;
    $('input[name="material_total[]"').each(function(){
      total += parseFloat($(this).val());
    });
    $('#totalMaterial').html(parseFloat(total).toFixed(2));
  }


  //PROCESOS

  //funcion para sumar el total
  function sumar(num){
    let tiro = $('#tiro-'+String(num)).val();
    let retiro = $('#retiro-'+String(num)).val();
    let millares = $('#mill-'+String(num)).val();
    let valor = $('#valor-'+String(num)).val();
    let sum = ((parseFloat(tiro) + parseFloat(retiro)) * parseFloat(millares)) * parseFloat(valor);
    $('#total_proceso-'+String(num)).val(parseFloat(sum).toFixed(2));
    sumarProcesos();
  }

  // sumar total procesos
  function sumarProcesos(){
    let total = 0.00;
    $('input[name="total_proceso[]"').each(function(){
      total += parseFloat($(this).val());
    });
    $('#totalProcesos').html(parseFloat(total).toFixed(2));
  }

  //sumar total abonospedidos
  function sumarabonos(counter){
    var i, valorpedidos = 0;
    for( i=1; i<counter+1; i++){
      var valor = document.getElementById('valorabono'+String(i)).value;
      valorpedidos += parseFloat(valor);
    }
    document.getElementById('totalabonos').value = parseFloat(valorpedidos).toFixed(2);
    document.getElementById('abonos').value = parseFloat(valorpedidos).toFixed(2);

    var abono = document.getElementById('abonos').value;
    var totalorden = document.getElementById('totalorden').value;
    totalorden -= parseFloat(abono);
    document.getElementById('saldo').value = parseFloat(totalorden).toFixed(2);
  }

  //funcion pra check todos los checkbox
  $('#checkall').on('click', function () {
    $('input[name="terminado[]"').each(function(){
      // $(this).prop('checked', true);
      if (!$(this).is('checked')) {
        $(this).prop('checked',true);
      } else {
        $(this).prop('checked', false);
      }  
    });
  });
</script>
@endsection