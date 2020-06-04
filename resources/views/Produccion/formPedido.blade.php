<section id="datos-cliente">
  <h6><i class="fas fa-plus" onclick="openModal('addCliente')"></i>&nbsp; Datos del cliente</h6>
  <hr>
  <div class="form-row">
    <div class="form-group col-12 col-md-2">
      <label for="inicio">Inicio</label>
      <input type="date" name="inicio" id="inicio" class="form-control form-control-sm @error('inicio') is-invalid @enderror" value="{{ old('inicio') ? old('inicio') : (session('current.inicio') ? session('current.inicio') : date('Y-m-d')) }}">
    </div>
    <div class="form-group col-12 col-md-3">
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
          <option value="{{ $cli->contacto_id }}" 
            {{ old('cliente') ? (old('cliente') == $cli->ruc ? 'selected' : '' ) : (session('current.cliente') ? (session('current.cliente') == $cli->ruc ? 'selected' : '') : '') }}
          >
            {{ $cli->contacto->nombre.' '.$cli->contacto->apellido }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-12 col-md-3">
      <label for="telefono">Telefono</label>
      <input type="text" name="telefono" id="telefono" class="form-control form-control-sm" value="{{ old('telefono') }}" readonly>
    </div>
    <div class="form-group col-6 col-md-2">
      <label for="prioridad">Prioridad</label>
      <select class="form-control form-control-sm @error('prioridad') is-invalid @enderror" name="prioridad" id="prioridad">
        <option value="1" {{ old('prioridad') ? (old('prioridad') == '1' ? 'selected' : '') : (session('current.prioridad') == '1' ? 'selected' : '') }} >
          Normal
        </option>
        <option value="2" {{ old('prioridad') ? (old('prioridad') == '2' ? 'selected' : '') : (session('current.prioridad') == '2' ? 'selected' : '') }} >
          Urgente
        </option>
      </select>
    </div>
    <div class="form-group col-6 col-md-2">
      <label for="estado">Estado</label>
      <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" id="estado">
        <option value="1" {{ old('estado') ? (old('estado') == '1' ? 'selected' : '') : (session('current.estado') == '1' ? 'selected' : '') }}>
          Pendiente
        </option>
        <option value="2" {{ old('estado') ? (old('estado') == '2' ? 'selected' : '') : (session('current.estado') == '2' ? 'selected' : '') }}>
          Pagado
        </option>
        <option value="3" {{ old('estado') ? (old('estado') == '3' ? 'selected' : '') : (session('current.estado') == '3' ? 'selected' : '') }}>
          Anulado
        </option>
        <option value="4" {{ old('estado') ? (old('estado') == '4' ? 'selected' : '') : (session('current.estado') == '4' ? 'selected' : '') }}>
          Canje
        </option>
      </select>
    </div>
  </div>
</section>

<hr style="border-width: 3px;">

@include('Produccion.Formularios.'.session("userInfo.empresa_tipo"))

<hr style="border-width: 3px;">

</section id="notas">
  <div class="form-group">
    <label for="notas"><i class="far fa-sticky-note"></i> Observaciones</label>
    <textarea class="form-control form-control-lg" name="notas" id="notas" rows="1"> {{ old('notas') ? old('notas') : session('current.notas') }} </textarea>
  </div>
</section>


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