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
/>

<x-blueBoard
  :title=$text
  :foot="[
    ['text'=>$action, 'href'=>'#', 'id'=>'formSubmit', 'tipo'=> 'link']
  ]"
>
  <form action="{{ $path }}" method="POST" id="form">
    @csrf
    @method($method)
    @php
      $utilidad = App\Security::hasModule('19');
      $clientes = App\Models\Ventas\Cliente::where('empresa_id', Auth::user()->empresa_id)->orderBy('cliente_empresa_id')->get();
    @endphp
    <section id="datos-cliente">
      <h6><i class="fas fa-plus" data-toggle="modal" data-target="#modalCliente"></i>&nbsp; Datos del cliente</h6>
      <hr>
      <div class="form-row">
        <div class="form-group col-12 col-md-3">
          <label for="cliente">Cliente</label>
          <select class="form-control form-control-sm @error('cliente_id') is-invalid @enderror" name="cliente_id" id="cliente" data-tags="true">
            <option disabled selected>Selecciona uno...</option>
            {{ $group =  $clientes->first()->cliente_empresa_id }}
            <optgroup label="{{ $clientes->first()->empresa->nombre }}">
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
          <input type="text" id="ruc" class="form-control form-control-sm" value="{{ old('ruc') }}" readonly>
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="telefono">Telefono</label>
          <input type="text" id="telefono" class="form-control form-control-sm" value="{{ old('telefono') }}" readonly>
        </div>
        <div class="form-group col-12 col-md-5">
          <label for="direccion">Dirección</label>
          <input type="text" id="direccion" class="form-control form-control-sm" value="{{ old('direccion') }}" readonly>
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
          <label for="empresa">Empresa</label>
          <select name="empresa" id="empresa" class="form-control form-control-sm refresh">
            @foreach ($empresas as $item)
            <option value="{{ $item->id }}">{{ $item->empresa }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-6 col-md form-group">
          <label for="tipo">Tipo</label>
          <select name="tipo" id="tipo" class="form-control form-control-sm refresh">
            <option value="1">Ingreso</option>
            <option value="0">Egreso</option>
          </select>
        </div>
        <div class="col-6 col-md form-group">
          <label for="cobro">Pago</label>
          <select class="form-control form-control-sm refresh" name="cobro" id="cobro">
            <option value="1">Efectivo</option>
            <option value="2">Cheque</option>
            <option value="3">Canje</option>
          </select>
        </div>
        <div class="col-6 col-md form-group">
          <label for="estado">Estado</label>
          <select name="estado" id="estado" class="form-control form-control-sm refresh">
            <option value="1">Pendiente</option>
            <option value="0">Pagado</option>
            <option value="2">Anulado</option>
          </select>
        </div>
      </div>
    </section>

    <hr style="border-width: 3px;">

    <section id="articulos">
      <table id="table-articulos" class="table table-sm table-responsive">
        <thead>
          <tr>
            <th scope="col" class="crudCol"><i id="addArticulo" class="fas fa-plus"></i></th>
            <th scope="col">Cantidad</th>
            <th scope="col" width="50%">Detalle</th>
            <th scope="col">% IVA</th>
            <th scope="col" class="text-right">Precio Unitario</th>
            <th scope="col" class="text-right">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @for ($i = 0; $i < 0; $i++)
          <tr id="{{'row-articulo-'.$i}}">
            <td>
              <i type="button" name="remove" id="{{'articulo-'.$i}}" class="fas fa-times removeRow"></i>
            </td>
            <td>
              <input type="number" name="articulo[cantidad][]" class="form-control form-control-sm text-center" value="{{old('articulo.cantidad.'.$i, $articulos[$i]->cantidad) ?? '0'}}" min="0" />
            </td>
            <td>
              <input type="text" name="articulo[detalle][]" class="form-control form-control-sm" value="{{old('articulo.detalle.'.$i, $articulos[$i]->detalle) ?? '0.00'}}"/>
            </td>
            <td>
              <select class="form-control form-control-sm selectProveedor" name="articulo[iva_id][]">
                @foreach($ivas as $iva)
                <option value="{{ $iva->id }}" {{old('articulo.iva_id.'.$i, $articulos[$i]->iva_id) == $iva->id ? 'selected' : ''}}>{{ $iva->porcentaje }}</option>
                @endforeach
              </select>
            </td>
            <td>
              <input type="number" name="articulo[valor_unitario][]" class="form-control form-control-sm text-center fixFloat" min="0" value="{{old('articulo.valor_unitario.'.$i, $articulos[$i]->valor_unitario) ?? '0.00'}}"/>
            </td>
            <td>
              <input type="number" name="articulo[subtotal][]" class="form-control form-control-sm fixFloat text-center" value="{{old('articulo.subtotal.'.$i, $articulos[$i]->subtotal) ?? '0.00'}}" step="0.01" min="0" onchange="sumarArticulo()" />
            </td>
          </tr>
          @endfor
        </tbody>
        <tfoot>
          <tr class="font-weight-bold">
            <td colspan="3"></td>
            <td colspan="2" class="text-right">Subtotal $</td>
            <td><input type="number" name="subtotal" id="subtotal" value="{{ old('subtotal', $factura->total_articulo) ?? '0.00'}}" class="form-control form-control-sm text-right fixFloat" readonly></td>
          </tr>
          <tr class="font-weight-bold">
            <td colspan="3"></td>
            <td colspan="2" class="text-right">Descuento <input type="number" id="descuentop" value="0" class="form-control form-control-sm w-25" style="display:inline!important" min="0" max="100" onclick="sumartotal()"> $</td>
            <td><input type="number" name="descuento" id="descuento" value="{{ old('descuento', $factura->descuento) ?? '0.00'}}" class="form-control form-control-sm text-right fixFloat" readonly></td>
          </tr>
          <tr class="font-weight-bold">
            <td colspan="3"></td>
            <td colspan="2" class="text-right">IVA {{$iva}} $</td>
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
        <div class="col-12 col-md form-inline d-flex justify-content-md-end">
          <div class="form-group">
            <label for="ret_iva_p">Iva</label>
            <select class="form-control form-control-sm mx-2" name="ret_iva_p" id="ret_iva_p">
              @foreach ($ret_iva as $ret)
              <option value="{{ $ret->id }}">{{ $ret->porcentaje }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="ret_iva">%:</label>
            <input type="number" class="form-control form-control-sm mx-2" name="ret_iva" id="ret_iva" readonly>
          </div>
        </div>
        <div class="col-12 col-md form-inline d-flex justify-content-md-end">
          <div class="form-group">
            <label for="ret_fnt_p">Fuente</label>
            <select class="form-control form-control-sm mx-2" name="ret_fnt_p" id="ret_fnt_p">
              @foreach ($ret_fnt as $ret)
              <option value="{{ $ret->id }}">{{ $ret->porcentaje }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="ret_fnt">%:</label>
            <input type="number" class="form-control form-control-sm mx-2" name="ret_fnt" id="ret_fnt" readonly>
          </div>
        </div>
        <div class="col-12 col-md form-inline d-flex justify-content-md-end">
          <div class="form-group">
            <label for="tot_cob">Total a cobrar $</label>
            <input type="number" class="form-control form-control-sm mx-2" name="tot_cob" id="tot_cob" readonly>
          </div>
        </div>
      </div>
    </section>

    <hr style="border-width: 3px;">

    </section id="notas">
      <div class="form-group">
        <label for="notas"><i class="far fa-sticky-note"></i> Observaciones</label>
        <textarea class="form-control form-control-sm" name="notas" id="notas" rows="2"> {{ old('notas', $factura->notas) }} </textarea>
      </div>
    </section>

    @section('modals1')
    <x-addCliente/>
    @endsection
  </form>
</x-blueBoard>
@endsection

@section('scripts')
<script>
  function getPhone(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url:"{{route('cliente.telefono')}}",
      type: 'post',
      dataType: "json",
      data: {
        'cliente_id': $('#cliente').val(),
      },
      success: function(data) {
        $('#telefono').val(data);
        // alert(data);
      },
      error: function(jqXhr, textStatus, errorThrown){
        console.log(errorThrown);
      }
    });
  }

  $('#cliente').change(function(){
    // alert($('#cliente').val());
    getPhone();
  });

  //ARTICULO
  var i = {{$i += 1}};
  var ivas_opts = '';
  $.each(@json($ivas), function(){ ivas_opts += '<option value=' + this.id + '>' + this.porcentaje + '</option>' });

  $('#addArticulo').click(function(){
    let table = $('#table-articulos > tbody');

    let button = $('<i />', {'type': 'button', 'class':'fas fa-times removeRow', 'name': 'remove', 'id':'articulo-'+i});

    let cantidad = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm text-center', 'value': '0', 'name': 'articulo[cantidad][]', 'id': 'articulo_cantidad_'+i, 'data-index':i, 'min': '0', 'onchange':'sumar('+i+');'});

    let detalle = $('<input />', {'type': 'text', 'class': 'form-control form-control-sm', 'name':'articulo[detalle][]'});

    let iva = $('<select />', {'name' : 'articulo[iva][]', 'id': 'articulo_iva_'+i, 'class': 'form-control form-control-sm text-center', 'onchange':'sumar('+i+');'}).append(ivas_opts);

    let unitario = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm text-right fixFloat', 'value': '0.00', 'name':'articulo[valor_unitario][]', 'id': 'articulo_valor_unitario_'+i, 'min': '0', 'onchange':'sumar('+i+');'});

    let subtotal = $('<input />', {'type': 'number', 'class': 'form-control form-control-sm text-right fixFloat', 'value': '0.00', 'name':'articulo[subtotal][]', 'id': 'articulo_subtotal_'+i, 'readonly':'readonly', 'min': '0'});

    newRow(table, [button, cantidad, detalle, iva, unitario, subtotal], 'row-articulo-'+i);
    i++;
  });

  function getDesc(){
    let descp = parseFloat($('#descuentop').val())/100;
    let desc = (parseFloat($('#subtotal').val()) * descp).toFixed(2);
    $('#descuento').val(desc);
    return desc;
  }

  //funcion para obtener las retenciones
  function getRet(){
    var iva = parseFloat($("#iva").val());
    var subtot = parseFloat($("#subtotal").val());
    var tot = parseFloat($("#total").val());
    var ivap = parseFloat($('#retivap option:selected').text())/100;
    var totp = parseFloat($('#retfuentep option:selected').text())/100;
    $("#retiva").val((iva*ivap).toFixed(2));
    $("#retfuente").val((subtot*totp).toFixed(2));
    $("#totret").val(parseFloat(tot-(iva*ivap)-(subtot*totp)).toFixed(2));
  }

  // sumar total procesos
  function sumartotal(){
    let indx, valor = 0, iva_tot = 0, iva_0 = 0;

    for(indx = 1; indx < i; indx++){
      let iva = parseFloat($('#articulo_iva_'+String(indx)+' option:selected').text());
      let sub_prod = parseFloat($('#articulo_subtotal_'+String(indx)).val());
      let descp = parseFloat($('#descuentop').val())/100;

      if(iva != 0){
        let ivap = iva/100;
        iva_tot += (sub_prod - (sub_prod * descp)) * ivap;
      } else {
        iva_0 += sub_prod - (sub_prod * descp);
      }

      valor += sub_prod;
    }

    $('#subtotal').val(valor.toFixed(2));
    let desc = getDesc();
    $('#iva').val(iva_tot.toFixed(2));
    $('#iva_0').val(iva_0.toFixed(2));
    $('#total').val((valor + iva_tot - desc).toFixed(2));
    console.log(valor, desc, iva_tot, iva0);
    getRet();
  }

  // funcion para sumar el total
  function sumar(num){
    let cant = $('#articulo_cantidad_'+String(num)).val();
    let valor = $('#articulo_valor_unitario_'+String(num)).val();
    $('#articulo_subtotal_'+String(num)).val(parseFloat(parseFloat(cant) * parseFloat(valor)).toFixed(2));
    sumartotal();
  }

  $('#formSubmit').click(function(){
    $('#form').submit();
  });

  // function print(){
  //   $('#form').printArea();
  // };
</script>
@endsection
