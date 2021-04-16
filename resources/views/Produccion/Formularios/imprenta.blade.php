@php
  $proveedores = App\Models\Produccion\Proveedor::where('empresa_id', Auth::user()->empresa_id)->get();
  $materiales = App\Models\Produccion\Material::where('empresa_id', Auth::user()->empresa_id)->orderBy('categoria_id')->with('categoria')->get();
  $servicios = App\Models\Produccion\Servicio::where('empresa_id', Auth::user()->empresa_id)->orderBy('area_id')->with('area')->with('subservicios')->get();
  $tintas = App\Models\Produccion\Tinta::where('empresa_id', Auth::user()->empresa_id)->get();
  $oldTintasTiro = old('tinta_tiro') ?? $pedido->tintas->reject(function($tinta){return $tinta->lado == 0;})->map(function($tintas){return $tintas->tinta_id;})->toArray();
  $oldTintasRetiro = old('tinta_retiro') ?? $pedido->tintas->reject(function($tinta){return $tinta->lado == 1;})->map(function($tintas){return $tintas->tinta_id;})->toArray();
  $oldMaterial = $pedido->material ?? json_encode(new stdClass);
  $oldProcesos = $pedido->servicios ?? json_encode(new stdClass);
  $oldAbonos = $pedido->abonos ?? json_encode(new stdClass);
  $matCount = count(old("material.id", $oldMaterial) ?? []);
  $proCount = count(old("proceso.id", $oldProcesos) ?? []);
  $aboCount = count(old("abono.valor", $oldAbonos) ?? []);
@endphp

<section id="descripcion">
  <div class="form-row">
    <div class="form-group col-12 col-md-6">
      <div class="form-group">
        <label for="descripcion"><b>Descripcion del trabajo</b></label>
        <textarea class="form-control form-control-sm" name="detalle" id="descripcion" rows="1">{{ old('detalle', $pedido->detalle) }}</textarea>
      </div>
    </div>
    <div class="form-group col-8 col-md-4">
      <label for="papel">Papel</label>
      <textarea class="form-control form-control-sm" name="papel" id="papel" rows="1">{{ old('papel', $pedido->papel) }}</textarea>
    </div>
    <div class="form-group col-4 col-md-2">
      <label for="cantidad">Cantidad</label>
      <input type="number" name="cantidad" id="cantidad" class="form-control form-control-sm" min="0" value="{{ old('cantidad', $pedido->cantidad) ?? '0' }}">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-6 col-md-3 order-1">
      <label for="corte">Corte Final</label>
      <div class="form-row" id="corte">
        <div class="col-6">
          <input type="number" name="corte_ancho" id="corte_ancho" class="form-control form-control-sm fixFloat"  value="{{ old('corte_ancho', $pedido->corte_ancho) ?? '0.00' }}"  min="0" step="0.01" aria-describedby="help_corte_ancho">
          <small id="help_corte_ancho" class="text-muted">Ancho</small>
        </div>
        <div class="col-6">
          <input type="number" name="corte_alto" id="corte_alto" class="form-control form-control-sm fixFloat" value="{{ old('corte_alto', $pedido->corte_alto) ?? '0.00' }}" min="0" step="0.01" aria-describedby="help_corte_alto">
          <small id="help_corte_alto" class="text-muted">Alto</small>
        </div>
      </div>
    </div>
    <div class="form-group col-12 col-md-5 order-3 order-md-2">
      <label for="tintas">Tintas</label>
      <div class="form-row" id="tintas">
        <div class="col-6">
          <select name="tinta_tiro[]" id="tinta_tiro" class="form-control form-control-sm d-print-none" aria-describedby="help_tintas_tiro" multiple>
            @foreach ($tintas as $tinta)
            <option value="{{ $tinta->id }}" {{ in_array($tinta->id, $oldTintasTiro) ? 'selected' : '' }}>{{ $tinta->color }}</option>
            @endforeach
          </select>
          <small id="help_tintas_tiro" class="text-muted">Tiro</small>
        </div>
        <div class="col-6">
          <select name="tinta_retiro[]" id="tinta_retiro" class="form-control form-control-sm" aria-describedby="help_tintas_retiro" multiple>
            @foreach ($tintas as $tinta)
            <option value="{{ $tinta->id }}" {{ in_array($tinta->id, $oldTintasRetiro) ? 'selected' : '' }}>{{ $tinta->color }}</option>
            @endforeach
          </select>
          <small id="help_tintas_retiro" class="text-muted">Retiro</small>
        </div>
      </div>
    </div>
    <div class="form-group col-6 col-md-4 order-2 order-md-3">
      <label for="numerado">Numerado</label>
      <div class="form-row" id="numerado">
        <div class="col-6">
          <input type="number" name="numerado_inicio" id="numerado_inicio" class="form-control form-control-sm" value="{{ old('numerado_inicio', $pedido->numerado_inicio) ?? '0' }}" min="0" aria-describedby="help_numerado_inicio">
          <small id="help_numerado_inicio" class="text-muted">Inicial</small>
        </div>
        <div class="col-6">
          <input type="number" name="numerado_fin" id="numerado_fin" class="form-control form-control-sm" value="{{ old('numerado_fin', $pedido->numerado_fin) ?? '0' }}" min="0" aria-describedby="help_numerado_fin">
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
        <th scope="col" style="width: 30%; min-width:150px"><b>Solicitud de material</b></th>
        <th scope="col" class="text-center">Cantidad</th>
        <th scope="col" colspan="2" class="text-center">Corte</th>
        <th scope="col" class="text-center">Tamaños</th>
        <th scope="col" style="width: 20%; min-width:150px"><i data-toggle="modal" data-target="#modalProveedor" class="fas fa-plus"></i> Proveedor</th>
        <th scope="col" class="text-center">Factura</th>
        <th scope="col" class="text-center" style="width:10%">Total</th>
      </tr>
    </thead>
    <tbody>
      @for ($i = 0; $i < $matCount; $i++)
      <tr id="{{'row-material-'.$i}}">
        <td>
          <i type="button" name="remove" id="{{'material-'.$i}}" class="fas fa-times removeRow"></i>
        </td>
        <td>
          <select class="form-control form-control-sm select2Class" name="material[id][]">
            <option selected value="null">Seleccione uno...</option>
            {{ $group =  $materiales->first()->categoria_id ?? '' }}
            <optgroup label="{{ $materiales->first()->categoria->categoria ?? '' }}">
            @foreach($materiales as $mat)
            @if ($group != $mat->categoria_id)
            {{ $group =  $mat->categoria_id }}
            <optgroup label="{{ $mat->categoria->categoria }}">
            @endif
            <option value="{{ $mat->id }}" {{(old('material.id.'.$i) ?? $oldMaterial[$i]->material_id) == $mat->id ? 'selected' : ''}}>{{ $mat->descripcion }}</option>
            @endforeach
          </select>
        </td>
        <td>
          <input type="number" name="material[cantidad][]" class="form-control form-control-sm text-center" value="{{(old('material.cantidad.'.$i) ?? $oldMaterial[$i]->cantidad) ?? '0'}}" min="0" />
        </td>
        <td>
          <input type="number" name="material[corte_alt][]" class="form-control form-control-sm fixFloat text-center" value="{{(old('material.corte_alt.'.$i) ?? $oldMaterial[$i]->corte_alto) ?? '0.00'}}" step="0.01" min="0" />
        </td>
        <td>
          <input type="number" name="material[corte_anc][]" class="form-control form-control-sm fixFloat text-center" value="{{(old('material.corte_anc.'.$i) ?? $oldMaterial[$i]->corte_ancho) ?? '0.00'}}" step="0.01" min="0" />
        </td>
        <td>
          <input type="number" name="material[tamanios][]" class="form-control form-control-sm text-center" value="{{(old('material.tamanios.'.$i) ?? $oldMaterial[$i]->tamanos) ?? '0'}}" min="0" />
        </td>
        <td>
          <select class="form-control form-control-sm select2Class" name="material[proveedor][]">
            <option selected disabled>Seleccione uno...</option>
            @foreach($proveedores as $prov)
            <option value="{{ $prov->id }}" {{(old('material.proveedor.'.$i) ?? $oldMaterial[$i]->proveedor_id) == $prov->id ? 'selected' : ''}}>{{ $prov->proveedor }} / {{ $prov->telefono }}</option>
            @endforeach
          </select>
        </td>
        <td>
          <input type="number" name="material[factura][]" class="form-control form-control-sm text-center" min="0" value="{{(old('material.factura.'.$i) ?? $oldMaterial[$i]->factura) ?? ''}}"/>
        </td>
        <td>
          <input type="number" name="material[total][]" class="form-control form-control-sm fixFloat text-center" value="{{(old('material.total.'.$i) ?? $oldMaterial[$i]->total) ?? '0.00'}}" step="0.01" min="0" onchange="sumarMaterial()" />
        </td>
      </tr>
      @endfor
    </tbody>
    <tfoot>
      <tr class="font-weight-bold">
        <td colspan="2"><a class="text-muted d-print-none" href="http://www.pplanos.com/" target="_blank">Corte de papel</a></td>
        <td colspan="4" class="text-right"></td>
        <td colspan="2" class="text-right"><a id="printable" data-target="material" class="d-print-none"><i class="fas fa-print pr-2"></i></a>  Total material $</td>
        <td class="text-center"><input type="number" name="total_material" id="totalMaterial" value="{{ old('total_material', $pedido->total_material) ?? '0.00'}}" class="form-control form-control-sm text-center" readonly></td>
      </tr>
    </tfoot>
  </table>
</section>

<hr style="border-width: 3px;">
<section id="procesos">
  <table id="table-procesos" class="table table-sm table-responsive-sm">
    <thead>
      <tr>
        <th scope="col" class="crudCol"><i id="addProceso" class="fas fa-plus"></i></th>
        <th scope="col" style="width: 50%; min-width:200px"><b>Procesos</b></th>
        <th scope="col" class="text-center">T</th>
        <th scope="col" class="text-center">R</th>
        <th scope="col" class="text-center">Mill</th>
        <th scope="col" class="text-center">V/U</th>
        <th scope="col" class="text-center">Total</th>
        <th scope="col" class="crudCol"><i class="fas fa-check" id="checkall"></i></th>
      </tr>
    </thead>
    <tbody>
      @for ($j = 0; $j < $proCount; $j++)
      <tr id="{{'row-proceso-'.$j}}">
        <td>
          <i type="button" name="remove" id="{{'proceso-'.$j}}" class="fas fa-times removeRow"></i>
        </td>
        <td>
          <select class="form-control form-control-sm select2Class" name="proceso[id][]">
            <option selected value="null">Seleccione uno...</option>
            {{ $group =  $servicios->first()->area_id }}
            <optgroup label="{{ $servicios->first()->area->area }}">
            @foreach($servicios as $serv)
              @if ($group != $serv->area_id)
              {{ $group = $serv->area_id }}
              </optgroup>
              <optgroup label="{{ $serv->area->area }}">
              @endif
              @if ($serv->subprocesos == 0)
              <option value="{{ $serv->id }}" {{(old('proceso.id.'.$j) ?? $oldProcesos[$j]->servicio_id) == $serv->id ? 'selected' : '' }}>{{ $serv->servicio }}</option>
              @else
              <option disabled>{{ $serv->servicio }}</option>
                {{ $subservicios = $serv->subservicios }}
                @foreach($subservicios as $sub)
                <option value="{{$serv->id}}.{{$sub->id}}" {{ old('proceso.id.'.$j) ? (old('proceso.id.'.$j) == ($serv->id.'.'.$sub->id) ? 'selected' : '') : ($oldProcesos[$j]->subservicio_id == $sub->id ? 'selected' : '') }}>&nbsp;&nbsp;&nbsp;&nbsp;{{ $sub->subservicio }}</option>
                @endforeach
              @endif
            @endforeach
            </optgroup>
          </select>
        </td>
        <td>
          <input type="number" name="proceso[tiro][]" id="{{'tiro-'.$j}}" class="form-control form-control-sm text-center" value="{{(old('proceso.tiro.'.$j) ?? $oldProcesos[$j]->tiro) ?? '1' }}" min="0" onchange="sumar('{{$j}}')" />
        </td>
        <td>
          <input type="number" name="proceso[retiro][]" id="{{'retiro-'.$j}}" class="form-control form-control-sm text-center" value="{{(old('proceso.retiro.'.$j) ?? $oldProcesos[$j]->retiro) ?? '0' }}" min="0" onchange="sumar('{{$j}}')" />
        </td>
        <td>
          <input type="number" name="proceso[millar][]" id="{{'mill-'.$j}}" class="form-control form-control-sm text-center" value="{{(old('proceso.millar.'.$j) ?? $oldProcesos[$j]->millares) ?? '1' }}" min="0" onchange="sumar('{{$j}}')" />
        </td>
        <td>
          <input type="number" name="proceso[valor][]" id="{{'valor-'.$j}}" class="form-control form-control-sm fixFloat text-center" value="{{(old('proceso.valor.'.$j) ?? $oldProcesos[$j]->valor_unitario) ?? '0.00' }}" step="0.01" min="0" onchange="sumar('{{$j}}')" />
        </td>
        <td>
          <input type="number" name="proceso[total][]" id="{{'total_proceso-'.$j}}" class="form-control form-control-sm text-center" value="{{(old('proceso.total.'.$j) ?? $oldProcesos[$j]->total) ?? '0.00' }}" step="0.01" min="0" readonly />
        </td>
        <td>
          {{-- <input type="checkbox" name="proceso[terminado][]" value="1" /> --}}
          <input type='hidden' value='{{(old('proceso.terminado.'.$j) ?? $oldProcesos[$j]->status) ?? '0' }}' name='proceso[terminado][]'><input type="checkbox" name="clicker[]" onclick="this.previousSibling.value=1-this.previousSibling.value" {{(old('proceso.terminado.'.$j) ?? $oldProcesos[$j]->status) == 1 ? 'checked' : '' }}>
        </td>
      </tr>
      @endfor
    </tbody>
    <tfoot>
      <tr class="font-weight-bold">
        <td colspan="4" rowspan="3" class="align-bottom">
          <div class="d-none d-print-flex text-center mh-100 justify-content-center">
            <div class="border-top w-50">{{ session('userInfo.nomina') }}</div>
          </div>
        </td>
        <td colspan="2" class="text-right">Total Pedido $</td>
        <td class="text-center"><input type="number" id="totalProcesos" name="total_pedido" value="{{ old('total_pedido', $pedido->total_pedido) ?? '0.00'}}" class="form-control form-control-sm text-center" readonly></td>
        <td></td>
      </tr>
      <tr>
        <td colspan="2" class="text-right">Abonos $</td>
        <td class="text-center"><input type="number" id="totalAbonos" name="abono" value="{{ old('abono', $pedido->abono) ?? '0.00'}}" class="form-control form-control-sm text-center" readonly></td>
        <td><i data-toggle="modal" data-target="#modalAbonos" class="fas fa-eye"></i></td>
      </tr>
      <tr>
        <td colspan="2" class="text-right">Saldo $</td>
        <td class="text-center"><input type="number" id="totalSaldo" name="saldo" value="{{ old('saldo', $pedido->saldo) ?? '0.00'}}" class="form-control form-control-sm text-center" readonly></td>
        <td></td>
      </tr>
    </tfoot>
  </table>
</section>


@section('modals2')
<x-addProveedor />

<!-- Modal Abonos -->
<div class="modal fade" id="modalAbonos" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Abonos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form action="{{route('abonos', isset($pedido->id))}}" method="POST" role="form">
        @csrf
        <table id="table-abonos" class="table table-sm table-responsive">
          <thead>
            <tr>
              <td scope="col" class="crudCol"><i id="addAbono" class="fas fa-plus"></i></td>
              <td scope="col">Fecha</td>
              <td scope="col">Usuario</td>
              <td scope="col">Forma de pago</td>
              <td scope="col" style="width:15%">Valor $</td>
            </tr>
          </thead>
          <tbody>
            @for ($k = 0; $k < $aboCount; $k++)
            <tr id="{{'row-abono-'.$k}}">
              <td><i type="button" name="remove" id="{{'abono-'.$k}}" class="fas fa-times removeRow"></i></td>
              <td>{{ date('Y-m-d') }}</td>
              <td>{{ Auth::user()->usuario }}</td>
              <td><input type="text" name="abono[pago][]" class="form-control form-control-sm" value="{{ old('abono.pago.'.$k) ?? $oldAbonos[$k]->forma_pago}}"></td>
              <td><input type="number" name="abono[valor][]" class="form-control form-control-sm text-center fixFloat" min="0" step="0.01" onchange="sumarAbonos()" value="{{(old('abono.valor.'.$k) ?? $oldAbonos[$k]->valor) ?? '0.00'}}"></td>
            </tr>
            @endfor
          </tbody>
          <tfoot>
            <tr class="font-weight-bold">
              <td colspan="4" class="text-right">Total $</td>
              <td class="text-center"><input id="abonos" class="form-control form-control-sm text-center" type="number" readonly name="totalAbonos" value="{{old('totalAbonos', $pedido->abono) ?? '0.00'}}"></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" @if ($method != 'PUT') disabled @endif>Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('after.after.scripts')
<script>
  $('#tinta_tiro').select2({
    maximumSelectionLength: 4,
  });

  $('#tinta_retiro').select2({
    maximumSelectionLength: 4,
  });

  //SOLICITUD DE MATERIALES
  var materiales = @json($materiales);
  var mat_grp = materiales[0].categoria_id;
  var mat_opts = "<option selected value='null'>Seleccione uno...</option></optgroup><optgroup label='"+materiales[0].categoria.categoria+"'>";
  $.each(materiales, function(indx, val){
    if (mat_grp != val.categoria_id){
      mat_grp = val.categoria_id;
      mat_opts += "</optgroup><optgroup label='"+val.categoria.categoria+"'>";
    }
    mat_opts += "<option value='"+val.id+"'>"+val.descripcion+"</option>";
  });

  var proveedores = @json($proveedores);
  var prov_opts = "<option selected value='null'>Seleccione uno...</option>";
  $.each(proveedores, function(indx, val){
    prov_opts += "<option value='"+val.id+"'>"+val.proveedor+" / "+val.telefono+"</option>";
  });

  var i = {{$i += 1}};
  $('#addMaterial').click(function(){
    let table = $('#table-materiales > tbody');

    let button = $('<i />', {'type': 'button', 'class':'fas fa-times removeRow', 'name': 'remove', 'id':'material-'+i});

    let material = $('<select />', {'name' : 'material[id][]', 'id': 'material_id_'+i, 'class': 'form-control form-control-sm select2Class'}).append(mat_opts);

    let cantidad = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm text-center', 'value': '0', 'name':'material[cantidad][]', 'id': 'material_cantidad_'+i, 'min': '0', 'onchange':'('+i+');'});

    let corte_alt = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm text-center fixFloat', 'value': '0.00', 'name':'material[corte_alt][]', 'id': 'material_corte_alt_'+i, 'min': '0', 'step':'0.01'});

    let corte_anc = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm text-center fixFloat', 'value': '0.00', 'name':'material[corte_anc][]', 'id': 'material_corte_anc_'+i, 'min': '0', 'step':'0.01'});

    let tamanios = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm text-center', 'value': '0', 'name':'material[tamanios][]', 'id': 'material_tamanios_'+i, 'min': '0'});

    let proveedor = $('<select />', {'name' : 'material[proveedor][]', 'id': 'material_proveedor_'+i, 'class': 'form-control form-control-sm select2Class'}).append(prov_opts);

    let factura = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm text-center', 'name':'material[factura][]', 'id': 'material_factura_'+i, 'min': '0'});

    let total = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm text-right fixFloat', 'value': '0.00', 'name':'material[total][]', 'id': 'material_total_'+i, 'min': '0', 'step':'0.01', 'onchange':'sumarMaterial();'});

    newRow(table, [button, material, cantidad, corte_alt, corte_anc, tamanios, proveedor, factura, total], 'row-material-'+i);
    $('.select2Class').select2();
    i++;
  });

  //sumar total pedidos
  function sumarMaterial(){
    let total = 0.00;
    $('input[name="material[total][]"]').each(function(){
      total += parseFloat($(this).val());
    });
    $('#totalMaterial').val(parseFloat(total).toFixed(2));
  }


  //PROCESOS
  var servicios = @json($servicios);
  var serv_grp = servicios[0].area_id;
  var serv_opts = "<option selected value='null'>Seleccione uno...</option><optgroup label='"+servicios[0].area.area+"'>";

  $.each(servicios, function(indx, val){
    if (serv_grp != val.area_id){
      serv_grp = val.area_id;
      serv_opts += "</optgroup><optgroup label='"+val.area.area+"'>";
    }
    if (val.subprocesos == 0){
      serv_opts += "<option value='"+val.id+"'>"+val.servicio+"</option>";
    } else {
      serv_opts += "<option disabled>"+val.servicio+"</option>";
      $.each(val.subservicios, (indxs, vals)=>{
        serv_opts += "<option value='"+val.id+vals.id+"'>&nbsp;&nbsp;&nbsp;&nbsp;"+vals.subservicio+"</option>";
      });
    }
  });
  // debugger

  $(function(){
    var i = {{$j += 1}};
    $('#addProceso').click(function(){
      let table = $('#table-procesos > tbody');

      let button = $('<i />', {'type': 'button', 'class':'fas fa-times removeRow', 'name': 'remove', 'id':'proceso-'+i});

      let proceso = $('<select />', {'name' : 'proceso[id][]', 'id': 'proceso-'+i, 'class': 'form-control form-control-sm select2Class'}).append(serv_opts);

      let tiro = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm text-center', 'value': '1', 'name':'proceso[tiro][]', 'id': 'tiro-'+i, 'min': '0', 'onchange':'sumar('+i+');'});

      let retiro = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm text-center', 'value': '0', 'name':'proceso[retiro][]', 'id': 'retiro-'+i, 'min': '0', 'onchange':'sumar('+i+');'});

      let millar = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm text-center', 'value': '1', 'name':'proceso[millar][]', 'id': 'mill-'+i, 'min': '0', 'onchange':'sumar('+i+');'});

      let valor = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm text-center fixFloat', 'value': '0.00', 'step': '0.01', 'name':'proceso[valor][]', 'id': 'valor-'+i, 'min': '0', 'onchange':'sumar('+i+');'});

      let total = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm text-center fixFloat', 'value': '0.00', 'step': '0.01', 'name':'proceso[total][]', 'id': 'total_proceso-'+i, 'min': '0', 'onchange':'sumar('+i+');', 'readonly': 'readonly'});

      let terminado = $('<input />', {'type': 'hidden', 'value': '0', 'name':'proceso[terminado][]'}).append($('<input />', {'type': 'checkbox', 'name':'clicker[]', 'onClick': 'this.previousSibling.value=1-this.previousSibling.value'}));

      newRow(table, [button, proceso, tiro, retiro, millar, valor, total, terminado], 'row-proceso-'+i);
      $('.select2Class').select2();
      i++;
    });
  });

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
    $('input[name="proceso[total][]"]').each(function(){
      total += parseFloat($(this).val());
    });
    $('#totalProcesos').val(parseFloat(total).toFixed(2));
    sumarSaldo();
  }


  //ABONOS
  $(function(){
    var i = {{$k += 1}};
    const mod = '{{ $method }}';
    $('#addAbono').click(function(){
      if(mod == 'POST'){
        $('#errorDiv').append('<div class="alert alert-danger" role="alert">Primero debes crear el pedido.&nbsp&nbsp<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        return;
      }
      let table = $('#table-materiales > tbody');

      let button = $('<i />', {'type': 'button', 'class':'fas fa-times removeRow', 'name': 'remove', 'id':'-'+i});

      let  = $('<select />', {'name' : '[][]', 'id': '_'+i, 'class': 'form-control form-control-sm text-center', 'onchange':'('+i+');'});

      let  = $('<input />', {'type': '', 'class': 'form-control form-control-sm text-right fixFloat', 'value': '0.00', 'name':'[][]', 'id': '_'+i, 'min': '0', 'onchange':'('+i+');'});

      let  = $('<input />', {'type': '', 'class': 'form-control form-control-sm text-right fixFloat', 'value': '0.00', 'name':'[][]', 'id': '_'+i, 'min': '0', 'onchange':'('+i+');'});

      $('#table-abonos > tbody').append('<tr id="row-abono-'+i+'">'+
        '<td><i type="button" name="remove" id="abono-'+i+'" class="fas fa-times removeRow"></i></td>'+
        '<td>{{ date("Y-m-d") }}</td>'+
        '<td>{{ Auth::user()->usuario }}</td>'+
        '<td><input type="text" name="abono[pago][]" class="form-control form-control-sm"></td>'+
        '<td><input type="number" name="abono[valor][]" class="form-control form-control-sm text-center fixFloat" min="0" step="0.01" value="0.00" onchange="sumarAbonos()" ></td>'+
      '</tr>');
      i++;
    });
  });

  //sumar total pedidos
  function sumarAbonos(){
    let total = 0.00;
    $('input[name="abono[valor][]"]').each(function(){
      total += parseFloat($(this).val());
    });
    $('#totalAbonos').val(parseFloat(total).toFixed(2));
    $('#abonos').val(parseFloat(total).toFixed(2));
    sumarSaldo();
  }

  //funcion para sumar saldo
  function sumarSaldo(){
    let total = $('#totalProcesos').val();
    let abono = $('#totalAbonos').val();
    $('#totalSaldo').val(parseFloat(total-abono).toFixed(2));
  }


  //funcion pra check todos los checkbox
  $('#checkall').on('click', function () {
    if ($('input[name="clicker[]"]:checked').length == $('input[name="clicker[]"]').length){
      $('input[name="clicker[]"]').each(function(){
        $(this).prop('checked', false);
      });
      $('input[name="proceso[terminado][]"]').each(function(){
        $(this).val('0');
      });
    } else {
      $('input[name="clicker[]"]').each(function(){
        $(this).prop('checked', true);
      });
      $('input[name="proceso[terminado][]"]').each(function(){
        $(this).val('1');
      });
    }
  });

  $("#printable").on("click", event => {
    let target = "#" + $("#printable").data("target");
    $(".select2Class").select2("destroy");
    $(target).print();
    $(".select2Class").select2();
  });
</script>
@endsection
