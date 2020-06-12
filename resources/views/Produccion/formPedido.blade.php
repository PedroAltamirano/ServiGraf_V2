@php
  $utilidad = App\Security::hasModule('19');
  $clientes = App\Models\Ventas\Cliente::where('empresa_id', Auth::user()->empresa_id)->get();
@endphp
<section id="datos-cliente">
  <h6><i class="fas fa-plus" data-toggle="modal" data-target="#modalCliente"></i>&nbsp; Datos del cliente</h6>
  <hr>
  <div class="form-row">
    <div class="form-group col-6 col-md-2 order-1">
      <label for="inicio">Inicio</label>
      <input type="date" name="inicio" id="inicio" class="form-control form-control-sm @error('inicio') is-invalid @enderror" value="{{ old('inicio', $pedido->fecha_entrada) ?? date('Y-m-d') }}">
    </div>
    <div class="form-group col-12 col-md-3 order-3 order-md-2">
      <label for="cliente">Cliente</label>
      <select class="form-control form-control-sm @error('cliente') is-invalid @enderror" name="cliente" id="cliente" data-tags="true">
        <option disabled selected>Selecciona uno...</option>
        {{ $group =  $clientes->first()->cliente_empresa_id }}
        <optgroup label="{{ $clientes->first()->empresa->nombre }}">
        @foreach ($clientes as $cli)
          @if ($group != $cli->cliente_empresa_id)
          {{ $group =  $cli->cliente_empresa_id }}
          <optgroup label="{{ $cli->empresa->nombre }}">
          @endif
          <option value="{{ $cli->id }}" 
            {{ old('cliente', $pedido->cliente_id) == $cli->id ? 'selected' : '' }}
          >
            {{ $cli->contacto->nombre.' '.$cli->contacto->apellido }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-12 col-md-2 order-4 order-md-3">
      <label for="telefono">Telefono</label>
      <input type="text" id="telefono" class="form-control form-control-sm" value="{{ old('telefono') }}" readonly>
    </div>
    <div class="form-group col-6 col-md-2 order-5 order-md-4">
      <label for="prioridad">Prioridad</label>
      <select class="form-control form-control-sm @error('prioridad') is-invalid @enderror" name="prioridad" id="prioridad">
        <option value="1" {{ old('prioridad', $pedido->prioridad)  == '1' ? 'selected' : '' }} >
          Normal
        </option>
        <option value="0" {{ old('prioridad', $pedido->prioridad) == '0' ? 'selected' : '' }} >
          Urgente
        </option>
      </select>
    </div>
    <div class="form-group col-6 col-md-2 order-6 order-md-5">
      <label for="estado">Estado</label>
      <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" id="estado">
        <option value="1" {{ old('estado', $pedido->estado) == '1' ? 'selected' : '' }}>
          Pendiente
        </option>
        <option value="2" {{ old('estado', $pedido->estado) == '2' ? 'selected' : '' }}>
          Pagado
        </option>
        <option value="3" {{ old('estado', $pedido->estado) == '3' ? 'selected' : '' }}>
          Anulado
        </option>
        <option value="4" {{ old('estado', $pedido->estado) == '4' ? 'selected' : '' }}>
          Canje
        </option>
      </select>
    </div>
    <div class="form-group col-6 col-md-1 order-2 order-md-6">
      <label for="cotizado" class="{{ $utilidad ? '' : 'text-white' }}">{{ $utilidad ? 'Cotizado $' : '.' }}</label>
      <input type="number" class="form-control form-control-sm text-center fixFloat" min="0" step="0.01" name="cotizado" id="cotizado" value="{{ old('cotizado', $pedido->cotizado) ?? '0.00'}}" {{ $utilidad ? '' : 'readonly' }}>
    </div>
  </div>
</section>

<hr style="border-width: 3px;">

@include('Produccion.Formularios.'.session("userInfo.empresa_tipo"))

<hr style="border-width: 3px;">

</section id="notas">
  <div class="form-group">
    <label for="notas"><i class="far fa-sticky-note"></i> Observaciones</label>
    <textarea class="form-control form-control-lg" name="notas" id="notas" rows="1"> {{ old('notas', $pedido->notas) }} </textarea>
  </div>
</section>

@section('modals1')
<!-- Modal Cliente -->
<div class="modal fade" id="modalCliente" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Crear Cliente</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form method="POST" action="{{ route('contacto.cliente.post') }}" role="form">
            @csrf
            @include('Ventas.contacto')
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('after.scripts')
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

  $('#formSubmit').click(function(){
    $('#form').submit();
  });
</script>

@yield('after.after.scripts')
@endsection

@section('document.ready')
$('#cliente').select2();

  @if (session('current.client'))
  getPhone();
  @endif

@endsection