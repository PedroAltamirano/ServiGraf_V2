@php
  $utilidad = App\Security::hasModule('19');
  $clientes = App\Models\Ventas\Cliente::where('empresa_id', Auth::user()->empresa_id)->orderBy('cliente_empresa_id')->get();
@endphp
<h1 class="text-center d-none d-print-block">{{ session('userInfo.empresa') }}</h1>
<h3 class="d-none d-print-block">Orden de trabajo No. <span class="font-weight-bold">{{ $pedido->numero }}</span></h3>
<section id="datos-cliente">
  <h6><i class="fas fa-plus" data-toggle="modal" data-target="#modalCliente"></i>&nbsp; Datos del cliente</h6>
  <hr>
  <div class="form-row">
    <div class="form-group col-6 col-md-2 order-1">
      <label for="inicio">Inicio</label>
      <input type="date" name="fecha_entrada" id="inicio" class="form-control form-control-sm @error('fecha_entrada') is-invalid @enderror" value="{{ old('fecha_entrada', $pedido->fecha_entrada) ?? date('Y-m-d') }}">
    </div>
    <div class="form-group col-12 col-md-3 order-3 order-md-2">
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
            {{ old('cliente_id', $pedido->cliente_id) == $cli->id ? 'selected' : '' }}
          >
            {{ $cli->contacto->nombre.' '.$cli->contacto->apellido }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-12 col-md-2 order-4 order-md-3">
      <label for="telefono">Telefono</label>
      <input type="text" id="cli_telefono" class="form-control form-control-sm" value="{{ old('telefono') }}" readonly>
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

<section id="notas">
  <div class="form-group">
    <label for="notas"><i class="far fa-sticky-note"></i> Observaciones</label>
    <textarea class="form-control form-control-sm" name="notas" id="notas" rows="2"> {{ old('notas', $pedido->notas) }} </textarea>
  </div>
</section>

@section('modals1')
<x-add-contacto />
@endsection

@section('after.scripts')
<script>
  const route = "{{route('cliente.info')}}";
  function getPhone(){
    axios.post(route, {
      cliente_id: $('#cliente').val(),
    }).then(res => {
      let data = res.data
      $('#cli_telefono').val(data.movil);
    }).catch(err => {
      swal('Oops!', err, 'error');
      console.log(err);
    });
  }

  $('#cliente').change(function(){
    getPhone();
  });

  $('.submitbtn').click(function(){
    let form = $(this).data('form');
    $(form).submit();
  });

  $(function(){
    @if (old('cliente_id', $pedido->cliente_id))
    getPhone();
    @endif
  });
</script>

@yield('after.after.scripts')
@endsection


