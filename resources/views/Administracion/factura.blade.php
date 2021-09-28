@extends('layouts.app')

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Facturas',
      'current' => false,
      'href' => route('facturacion'),
    ],
    [
      'text' => $text,
      'current' => true,
      'href' => '#',
    ]
  ]"
>
  <li class="breadcrumb-item" id="fact_num_path">
    <input type="number" name="number_vis" id="fact_num_vis" class="form-control form-control-sm" value="{{ $fact_num }}" readonly>
  </li>
</x-path>

<x-blue-board
  :title=$text
  :foot="[
    ['text'=>$action, 'href'=>'#', 'id'=>'formSubmit', 'tipo'=>'link']
  ]"
>
  <form action="{{ $path }}" method="POST" id="form">
    @csrf
    @method($method)
    <input type="hidden" name="numero" id="fact_num" value="{{ $fact_num }}">
    <section id="datos-cliente">
      <h6><i class="fas fa-plus" data-toggle="modal" data-target="#modalContacto"></i>&nbsp; Datos del cliente</h6>
      <hr>
      <div class="form-row">
        <div class="form-group col-12 col-md-3">
          <label for="cliente">Cliente</label>
          <select class="form-control form-control-sm select2Class @error('cliente_id') is-invalid @enderror" name="cliente_id" id="cliente" data-tags="true">
            <option disabled selected>Selecciona uno...</option>
            {{ $group =  $clientes->first()->cliente_empresa_id ?? 0 }}
            <optgroup label="{{ $clientes->first()->empresa->nombre ?? 'Sin Clientes' }}">
            @foreach ($clientes as $cli)
              @if ($group != $cli->cliente_empresa_id)
              {{ $group =  $cli->cliente_empresa_id }}
              <optgroup label="{{ $cli->empresa->nombre }}">
              @endif
              <option value="{{ $cli->id }}"
                {{ old('cliente_id', $factura->cliente_id) == $cli->id ? 'selected' : '' }}
              >
                {{ $cli->contacto->nombre.' '.$cli->contacto->apellido }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="ruc">RUC</label>
          <input type="text" id="ruc" name="ruc" class="form-control form-control-sm" value="{{ old('ruc') }}" readonly>
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="telefono">Telefono</label>
          <input type="text" id="telefono" name="telefono" class="form-control form-control-sm" value="{{ old('telefono') }}" readonly>
        </div>
        <div class="form-group col-12 col-md-5">
          <label for="direccion">Dirección</label>
          <input type="text" id="direccion" name="direccion" class="form-control form-control-sm" value="{{ old('direccion') }}" readonly>
        </div>

        <div class="form-group col-6 col-md-2">
          <label for="inicio">Emisión</label>
          <input type="date" name="emision" id="emision" class="form-control form-control-sm @error('emision') is-invalid @enderror" value="{{ old('emision', $factura->emision) ?? date('Y-m-d') }}">
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="inicio">Vencimiento</label>
          <input type="date" name="vencimiento" id="vencimiento" class="form-control form-control-sm @error('vencimiento') is-invalid @enderror" value="{{ old('vencimiento', $factura->vencimiento) ?? date('Y-m-d') }}">
        </div>
        <div class="col-6 col-md form-group">
          <label for="fact_emp_id">Empresa</label>
          <select name="fact_emp_id" id="fact_emp_id" class="form-control form-control-sm refresh">
            @foreach ($empresas as $item)
            <option value="{{ $item->id }}" {{ old('fact_emp_id', $factura->fact_emp_id) == $item->id ? 'selected' : '' }}>{{ $item->empresa }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-6 col-md form-group">
          <label for="tipo">Tipo</label>
          <select name="tipo" id="tipo" class="form-control form-control-sm refresh">
            <option value="1" {{ old('tipo', $factura->tipo) == 1 ? 'selected' : '' }}>Ingreso</option>
            <option value="0" {{ old('tipo', $factura->tipo) == 0 ? 'selected' : '' }}>Egreso</option>
          </select>
        </div>
        <div class="col-6 col-md form-group">
          <label for="tipo_pago">Pago</label>
          <select class="form-control form-control-sm refresh" name="tipo_pago" id="tipo_pago">
            <option value="1" {{ old('tipo_pago', $factura->tipo_pago) == 1 ? 'selected' : '' }}>Efectivo</option>
            <option value="2" {{ old('tipo_pago', $factura->tipo_pago) == 2 ? 'selected' : '' }}>Cheque</option>
            <option value="3" {{ old('tipo_pago', $factura->tipo_pago) == 3 ? 'selected' : '' }}>Canje</option>
          </select>
        </div>
        <div class="col-6 col-md form-group">
          <label for="estado">Estado</label>
          <select name="estado" id="estado" class="form-control form-control-sm refresh">
            <option value="1" {{ old('estado', $factura->estado) == 1 ? 'selected' : '' }}>Pendiente</option>
            <option value="0" {{ old('estado', $factura->estado) == 0 ? 'selected' : '' }}>Pagado</option>
            <option value="2" {{ old('estado', $factura->estado) == 2 ? 'selected' : '' }}>Anulado</option>
          </select>
        </div>
      </div>
    </section>

    <hr style="border-width: 3px;">

    <section id="articulos">
      <table id="table-articulos" class="table table-sm">
        <thead>
          <tr>
            <th scope="col" class="w-2"><i id="addProducto" class="fas fa-plus"></i></th>
            <th scope="col">Cantidad</th>
            <th scope="col" width="50%">Detalle</th>
            <th scope="col">% IVA</th>
            <th scope="col" class="text-right">Precio Unitario</th>
            <th scope="col" class="text-right">Subtotal</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
          <tr class="font-weight-bold">
            <td colspan="3"></td>
            <td colspan="2" class="text-right">Subtotal $</td>
            <td><input type="number" name="subtotal" id="subtotal" value="{{ old('subtotal', $factura->total_articulo) ?? '0.00'}}" class="form-control form-control-sm text-right fixFloat" readonly></td>
          </tr>
          <tr class="font-weight-bold">
            <td colspan="3"></td>
            <td colspan="2" class="text-right">Descuento <input type="number" id="descuento_p" name="descuento_p" value="0" class="form-control form-control-sm w-25" style="display:inline!important" min="0" max="100" onclick="sumartotal()"> $</td>
            <td><input type="number" name="descuento" id="descuento" value="{{ old('descuento', $factura->descuento) ?? '0.00'}}" class="form-control form-control-sm text-right fixFloat" readonly></td>
          </tr>
          <tr class="font-weight-bold">
            <td colspan="3"></td>
            <td colspan="2" class="text-right">IVA {{ $iva_p }} $</td>
            <td><input type="number" name="iva" id="iva" value="{{ old('iva', $factura->iva) ?? '0.00'}}" class="form-control form-control-sm text-right fixFloat" readonly></td>
          </tr>
          <tr class="font-weight-bold">
            <td colspan="3"></td>
            <td colspan="2" class="text-right">IVA 0 $</td>
            <td><input type="number" name="iva_0" id="iva_0" value="{{ old('iva_0', $factura->iva_0) ?? '0.00'}}" class="form-control form-control-sm text-right fixFloat" readonly></td>
          </tr>
          <tr class="font-weight-bold">
            <td colspan="3"></td>
            <td colspan="2" class="text-right">Total $</td>
            <td><input type="number" name="total" id="total" value="{{ old('total', $factura->total) ?? '0.00'}}" class="form-control form-control-sm text-right fixFloat" readonly></td>
          </tr>
        </tfoot>
      </table>
    </section>

    <hr style="border-width: 3px;">

    <section id="retenciones">
      <div class="row m-0">
        <h6 class="col-12 col-md m-0">Retenciones</h6>
        <div class="col-12 col-md form-inline p-0">
          <div class="form-group w-100 m-0">
            <label for="ret_iva_p">Iva</label>
            <select class="form-control form-control-sm mx-2 retencion" name="ret_iva_p" id="ret_iva_p">
              @foreach ($ret_iva as $ret)
              <option value="{{ $ret->id }}" {{ old('ret_iva_p', $factura->ret_iva_p) == $ret->id ? 'selected' : '' }}>{{ $ret->porcentaje }}</option>
              @endforeach
            </select>
            <label for="ret_iva">%:</label>
            <input type="number" class="form-control form-control-sm mx-2 w-25 text-right fixFloat" value="{{ old('ret_iva', $factura->ret_iva) ?? '0.00' }}" name="ret_iva" id="ret_iva" readonly>
          </div>
        </div>
        <div class="col-12 col-md form-inline p-0">
          <div class="form-group w-100 m-0">
            <label for="ret_fnt_p">Fuente</label>
            <select class="form-control form-control-sm mx-2 retencion" name="ret_fuente_p" id="ret_fnt_p">
              @foreach ($ret_fnt as $ret)
              <option value="{{ $ret->id }}" {{ old('ret_fuente_p', $factura->ret_fuente_p) == $ret->id ? 'selected' : '' }}>{{ $ret->porcentaje }}</option>
              @endforeach
            </select>
            <label for="ret_fnt">%:</label>
            <input type="number" class="form-control form-control-sm mx-2 w-25 text-right fixFloat" value="{{ old('ret_fuente', $factura->ret_fuente) ?? '0.00' }}" name="ret_fuente" id="ret_fnt" readonly>
          </div>
        </div>
        <div class="col-12 col-md form-inline p-0">
          <div class="form-group w-100 m-0">
            <label for="tot_cob">Total a cobrar $</label>
            <input type="number" class="form-control form-control-sm mx-2 w-50 text-right fixFloat" value="{{ old('total_pagar', $factura->total_pagar) ?? '0.00' }}" name="total_pagar" id="tot_cob" readonly>
          </div>
        </div>
      </div>
    </section>

    <hr style="border-width: 3px;">
    @php
      $pedidos_old = old('pedidos', $old_pedidos) ?? [];
    @endphp
    <section id="ots">
      <div class="form-group">
        <label for="pedidos">Pedidos</label>
        <select multiple class="form-control select2Class" name="pedidos[]" id="pedidos">
          @foreach ($pedidos as $pedido)
          <option value="{{ $pedido->id }}" {{ in_array($pedido->id, $pedidos_old) ? 'selected' : '' }}>{{ $pedido->numero }}</option>
          @endforeach
        </select>
      </div>
    </section>

    <hr style="border-width: 3px;">

    </section id="notas">
      <div class="form-group">
        <label for="notas"><i class="far fa-sticky-note"></i> Observaciones</label>
        <textarea class="form-control form-control-sm" name="notas" id="notas" rows="2"> {{ old('notas', $factura->notas) }} </textarea>
      </div>
    </section>
  </form>
</x-blue-board>

@php
  $opts_ivas = '<option disabled selected>Selecciona uno...</option>';
  foreach($ivas as $item){
    $opts_ivas .= "<option value='$item->id'>$item->porcentaje</option>";
  }

  $old_productos = $factura->productos;
  if($cnt = count(old('articulo_cantidad') ?? [])) {
    $old_productos = [];
    for($i = 0; $i < $cnt; $i++){
      $model = new \stdClass;
      $model->cantidad = old('articulo_cantidad')[$i];
      $model->detalle = old('articulo_detalle')[$i];
      $model->iva_id = old('articulo_iva_id')[$i];
      $model->valor_unitario = old('articulo_valor_unitario')[$i];
      $model->subtotal = old('articulo_subtotal')[$i];
      $old_productos[] = $model;
    }
  }
@endphp
@endsection

@section('modals')
<x-add-contacto />
@endsection

@section('scripts')
<script>
  const fact_num = {{ $fact_num }};
  const fact_new = {{ $factura->id ?? 0 }};

  // const route = `{{route('contacto.info')}}`;
  const route = `{{route('cliente.info')}}`;
  const getPhone = () => {
    axios.post(route, {
      cliente_id: $('#cliente').val(),
    }).then(res => {
      let data = res.data
      $('#ruc').val(data.ruc);
      $('#telefono').val(data.movil);
      $('#direccion').val(data.direccion);
    }).catch(error => {
      swal('Oops!', 'No hemos podido cargar los datos del cliente', 'error');
      console.log(error);
    });
  }

  $('#cliente').change(() => getPhone());

  $(() => { if(fact_new) getPhone() });

  $('#tipo').change(() => {
    let tipo = parseInt($('#tipo').val());
    if(tipo){
      $('#fact_num').val(fact_num);
      $('#fact_num_vis').val(fact_num).prop('readonly', true);
    } else {
      $('#fact_num').val(0);
      $('#fact_num_vis').val(0).prop('readonly', false);
    }
  });

  $('#fact_num_vis').change(() => $('#fact_num').val(parseInt($('#fact_num_vis').val())));

  //ARTICULO
  var i = 0;
  const opts_ivas = `@json($opts_ivas)`;
  const old_productos = JSON.parse(`@json($old_productos)`);

  const add_producto = (cantidad_val=0, detalle_val=null, iva_id_val=null, valor_unitario_val='0.00', subtotal_val='0.00') => {
    let table = $('#table-articulos > tbody');

    let button = $('<i />', {'type': 'button', 'class':'fas fa-times removeRow', 'name': 'remove', 'id': `articulo-${i}`});

    let cantidad = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm text-center', 'value': cantidad_val, 'name': 'articulo_cantidad[]', 'id': `articulo_cantidad_${i}`, 'data-index': i, 'min': '0', 'onchange': `sumar(${i});`});

    let detalle = $('<input />', {'type': 'text', 'class': 'form-control form-control-sm', 'name':'articulo_detalle[]', 'id': `articulo_detalle_${i}`, 'value': detalle_val});

    let iva = $('<select />', {'name' : 'articulo_iva_id[]', 'id': `articulo_iva_${i}`, 'class': 'form-control form-control-sm text-center', 'onchange': `sumar(${i});`}).append(opts_ivas);
    if(iva_id_val) iva.val(iva_id_val);

    let unitario = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm text-right fixFloat', 'value': valor_unitario_val, 'name':'articulo_valor_unitario[]', 'id': `articulo_valor_unitario_${i}`, 'min': '0', 'onchange': `sumar(${i});`});

    let subtotal = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm text-right fixFloat', 'value': subtotal_val, 'name':'articulo_subtotal[]', 'id': `articulo_subtotal_${i}`, 'readonly':'readonly', 'min': '0'});

    newRow(table, [button, cantidad, detalle, iva, unitario, subtotal], `row-articulo-${i}`);
    i++;
  }
  $('#addProducto').click(() => add_producto());
  if(old_productos != []){
    old_productos.map(item => {
      add_producto(item.cantidad, item.detalle, item.iva_id, item.valor_unitario, item.subtotal);
    });
  }

  const getDesc = () => {
    let descp = parseFloat($('#descuento_p').val())/100;
    let desc = (parseFloat($('#subtotal').val()) * descp).toFixed(4);
    $('#descuento').val(desc);
    return desc;
  }

  //funcion para obtener las retenciones
  const getRet = () => {
    let iva_p = fnt_p = 0;
    let iva = parseFloat($("#iva").val());
    let subtot = parseFloat($("#subtotal").val());
    let tot = parseFloat($("#total").val());

    if($('#ret_iva_p option:selected').length > 0){
      iva_p = $('#ret_iva_p option:selected').text();
    } else {
      alert('Selecciona un porcentaje de retención del iva.');
    }

    if($('#ret_fnt_p option:selected').length > 0){
      fnt_p = $('#ret_fnt_p option:selected').text();
    } else {
      alert('Selecciona un porcentaje de retención en la fuente.');
    }
    let ret_iva_p = parseFloat(iva_p)/100;
    let ret_fnt_p = parseFloat(fnt_p)/100;
    let ret_iva = (iva*ret_iva_p).toFixed(4);
    let ret_fnt = (subtot*ret_fnt_p).toFixed(4);

    $("#ret_iva").val(ret_iva);
    $("#ret_fnt").val(ret_fnt);
    $("#tot_cob").val(parseFloat(tot-ret_iva-ret_fnt).toFixed(4));
  }

  $('.retencion').change(() => getRet());

  // sumar total procesos
  const sumartotal = () => {
    let indx, valor = 0, iva_tot = 0, iva_0 = 0;

    for(indx = 0; indx < i; indx++){
      if ($(`#row-articulo-${String(indx)}`).length == 0) continue;

      let iva = parseFloat($(`#articulo_iva_${String(indx)} option:selected`).text());
      let sub_prod = parseFloat($(`#articulo_subtotal_${String(indx)}`).val());
      let descp = parseFloat($('#descuento_p').val())/100;

      if(iva != 0){
        let ivap = iva/100;
        iva_tot += (sub_prod - (sub_prod * descp)) * ivap;
      } else {
        iva_0 += sub_prod - (sub_prod * descp);
      }

      valor += sub_prod;
    }

    $('#subtotal').val(valor.toFixed(4));
    let desc = getDesc();
    $('#iva').val(iva_tot.toFixed(4));
    $('#iva_0').val(iva_0.toFixed(4));
    $('#total').val((valor + iva_tot - desc).toFixed(4));
    getRet();
  }

  // funcion para sumar el total
  const sumar = num => {
    let cant = $(`#articulo_cantidad_${String(num)}`).val();
    let valor = $(`#articulo_valor_unitario_${String(num)}`).val();
    $(`#articulo_subtotal_${String(num)}`).val(parseFloat(parseFloat(cant) * parseFloat(valor)).toFixed(4));
    sumartotal();
  }

  // function print(){
  //   $('#form').printArea();
  // };
</script>
@endsection
