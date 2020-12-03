@php
  $proveedores = App\Models\Produccion\Proveedor::where('empresa_id', Auth::user()->empresa_id)->get();
  $materiales = App\Models\Produccion\Material::where('empresa_id', Auth::user()->empresa_id)->orderBy('categoria_id')->get();
  $servicios = App\Models\Produccion\Servicio::where('empresa_id', Auth::user()->empresa_id)->orderBy('area_id')->get();
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
          <select name="tinta_tiro[]" id="tinta_tiro" class="form-control form-control-sm" aria-describedby="help_tintas_tiro" multiple>
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
          <select class="form-control form-control-sm selectMaterial" name="material[id][]">
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
          <select class="form-control form-control-sm selectProveedor" name="material[proveedor][]">
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
        <td colspan="2"><a class="text-muted" href="#">Corte de papel</a></td>
        <td colspan="4" class="text-right"></td>
        <td colspan="2" class="text-right"><i class="fas fa-print pr-2"></i>  Total material $</td>
        <td class="text-center"><input type="number" name="total_material" id="totalMaterial" value="{{ old('total_material', $pedido->total_material) ?? '0.00'}}" class="form-control form-control-sm text-center" readonly></td>
      </tr>
    </tfoot>
  </table>
</section>

<hr style="border-width: 3px;">
<section id="procesos">
  <table id="table-procesos" class="table table-sm table-responsive">
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
          <select class="form-control form-control-sm selectProceso" name="proceso[id][]">
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
        <td colspan="4"></td>
        <td colspan="2" class="text-right">Total Pedido $</td>
        <td class="text-center"><input type="number" id="totalProcesos" name="total_pedido" value="{{ old('total_pedido', $pedido->total_pedido) ?? '0.00'}}" class="form-control form-control-sm text-center" readonly></td>
        <td></td>
      </tr>
      <tr>
        <td colspan="4"></td>
        <td colspan="2" class="text-right">Abonos $</td>
        <td class="text-center"><input type="number" id="totalAbonos" name="abono" value="{{ old('abono', $pedido->abono) ?? '0.00'}}" class="form-control form-control-sm text-center" readonly></td>
        <td><i data-toggle="modal" data-target="#modalAbonos" class="fas fa-eye"></i></td>
      </tr>
      <tr>
        <td colspan="4"></td>
        <td colspan="2" class="text-right">Saldo $</td>
        <td class="text-center"><input type="number" id="totalSaldo" name="saldo" value="{{ old('saldo', $pedido->saldo) ?? '0.00'}}" class="form-control form-control-sm text-center" readonly></td>
        <td></td>
      </tr>
    </tfoot>
  </table>
</section>


@section('modals2')
<!-- Modal Proveedor -->
<div class="modal fade" id="modalProveedor" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crear proveedor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('proveedor.post') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="proveedor_nombre" id="proveedor_nombre">
          </div>
          <div class="form-group">
            <label for="telefono">Telefono</label>
            <input type="text" class="form-control" name="proveedor_telefono" id="proveedor_telefono">
          </div>
          <div class="form-group">
            <label for="direccion">Direccion</label>
            <input type="text" class="form-control" name="proveedor_direccion" id="proveedor_direccion">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>


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

  $('.selectProceso').select2();

  //SOLICITUD DE MATERIALES
  $(function(){
    var i = {{$i += 1}};
    $('#addMaterial').click(function(){
      $('#table-materiales > tbody').append('<tr id="row-material-'+i+'">'+
        '<td><i type="button" name="remove" id="material-'+i+'" class="fas fa-times removeRow"></i></td>'+
        '<td><select class="form-control form-control-sm selectMaterial" name="material[id][]"><option selected value="null">Seleccione uno...</option>{{ $group =  $materiales->first()->categoria_id ?? "" }}<optgroup label="{{ $materiales->first()->categoria->categoria ?? "" }}">@foreach($materiales as $mat)@if ($group != $mat->categoria_id){{ $group =  $mat->categoria_id }}<optgroup label="{{ $mat->categoria->categoria }}">@endif<option value="{{ $mat->id }}">{{ $mat->descripcion }}</option>@endforeach</select></td>'+
        '<td><input type="number" name="material[cantidad][]" class="form-control form-control-sm text-center" value="0" min="0" /></td>'+
        '<td><input type="number" name="material[corte_alt][]" class="form-control form-control-sm fixFloat text-center" value="0.00" step="0.01" min="0" /></td>'+
        '<td><input type="number" name="material[corte_anc][]" class="form-control form-control-sm fixFloat text-center" value="0.00" step="0.01" min="0" /></td>'+
        '<td><input type="number" name="material[tamanios][]" class="form-control form-control-sm text-center" value="0" min="0" /></td>'+
        '<td><select class="form-control form-control-sm selectProveedor" name="material[proveedor][]"><option selected disabled>Seleccione uno...</option>@foreach($proveedores as $prov)<option value="{{ $prov->id }}">{{ $prov->proveedor }} / {{ $prov->telefono }}</option>@endforeach</select></td>'+
        '<td><input type="number" name="material[factura][]" class="form-control form-control-sm text-center" min="0" /></td>'+
        '<td><input type="number" name="material[total][]" class="form-control form-control-sm fixFloat text-center" value="0.00" step="0.01" min="0" onchange="sumarMaterial()" /></td>'+
      '</tr>');
      $('.selectMaterial').select2();
      $('.selectProveedor').select2();
      i++;
    });
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
  $(function(){
    var i = {{$j += 1}};
    $('#addProceso').click(function(){
      $('#table-procesos > tbody').append('<tr id="row-proceso-'+i+'">'+
        '<td><i type="button" name="remove" id="proceso-'+i+'" class="fas fa-times removeRow"></i></td>'+
        '<td><select class="form-control form-control-sm selectProceso" name="proceso[id][]"><option selected value="null">Seleccione uno...</option>{{ $group =  $servicios->first()->area_id }}<optgroup label="{{ $servicios->first()->area->area }}"> @foreach($servicios as $serv) @if ($group != $serv->area_id){{ $group = $serv->area_id }}</optgroup><optgroup label="{{ $serv->area->area }}"> @endif @if ($serv->subprocesos == 0)<option value="{{ $serv->id }}">{{ $serv->servicio }}</option> @else<option disabled>{{ $serv->servicio }}</option>{{ $subservicios = $serv->subservicios }} @foreach($subservicios as $sub)<option value="{{$serv->id}}.{{$sub->id}}">&nbsp;&nbsp;&nbsp;&nbsp;{{ $sub->subservicio }}</option> @endforeach @endif @endforeach</optgroup></select></td>'+
        '<td><input type="number" name="proceso[tiro][]" id="tiro-'+i+'" class="form-control form-control-sm text-center" value="1" min="0" onchange="sumar('+i+')" /></td>'+
        '<td><input type="number" name="proceso[retiro][]" id="retiro-'+i+'" class="form-control form-control-sm text-center" value="0" min="0" onchange="sumar('+i+')" /></td>'+
        '<td><input type="number" name="proceso[millar][]" id="mill-'+i+'" class="form-control form-control-sm text-center" value="1" min="0" onchange="sumar('+i+')" /></td>'+
        '<td><input type="number" name="proceso[valor][]" id="valor-'+i+'" class="form-control form-control-sm fixFloat text-center" value="0.00" step="0.01" min="0" onchange="sumar('+i+')" /></td>'+
        '<td><input type="number" name="proceso[total][]" id="total_proceso-'+i+'" class="form-control form-control-sm text-center" value="0.00" step="0.01" min="0" readonly /></td>'+
        '<td><input type="hidden" value="0" name="proceso[terminado][]"><input type="checkbox" name="clicker[]" onclick="this.previousSibling.value=1-this.previousSibling.value"></td>'+
      '</tr>');
      $('.selectProceso').select2();
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
    const mod = '{{ $mod }}';
    $('#addAbono').click(function(){
      if(mod == '0'){
        $('#errorDiv').append('<div class="alert alert-danger" role="alert">Primero debes crear el pedido.&nbsp&nbsp<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        return;
      }
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
</script>
@endsection
