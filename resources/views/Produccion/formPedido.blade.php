@php
$utilidad = App\Security::hasModule('19');
@endphp
<div class="form-container" id="pedido-container">
  <h1 class="text-center d-none d-print-block">{{ session('userInfo.empresa') }}</h1>
  <h3 class="d-none d-print-block">Orden de trabajo No. <span class="font-weight-bold">{{ $pedido->numero }}</span></h3>
  <section id="datos-cliente">
    <h6><i class="fas fa-plus" data-toggle="modal" data-target="#modalContacto"></i>&nbsp; Datos del cliente</h6>
    <hr>
    <div class="form-row">
      <div class="form-group col-6 col-md-2 order-1">
        <label for="fecha_entrada">Inicio</label>
        <input type="date" name="fecha_entrada" id="fecha_entrada"
          class="form-control form-control-sm @error('fecha_entrada') is-invalid @enderror"
          value="{{ old('fecha_entrada', $pedido->fecha_entrada) ?? date('Y-m-d') }}">
      </div>
      <div class="form-group col-12 col-md-3 order-3 order-md-2">
        <x-cliente column='cliente_id' :old="old('cliente_id', $pedido->cliente_id)" />
      </div>
      <div class="form-group col-12 col-md-2 order-4 order-md-3">
        <label for="telefono">Telefono</label>
        <input type="text" id="telefono" class="form-control form-control-sm" value="{{ old('telefono') }}" readonly>
      </div>
      <div class="form-group col-6 col-md-2 order-5 order-md-4">
        <label for="prioridad">Prioridad</label>
        <select class="form-control form-control-sm @error('prioridad') is-invalid @enderror" name="prioridad"
          id="prioridad">
          @foreach (config('pedido.prioridad') as $key => $val)
            <option value="{{ $key }}" {{ old('prioridad', $pedido->prioridad) == $key ? 'selected' : '' }}>
              {{ $val }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-6 col-md-2 order-6 order-md-5">
        <label for="estado">Estado</label>
        <select class="form-control form-control-sm @error('estado') is-invalid @enderror" name="estado" id="estado">
          @foreach (config('pedido.estados') as $key => $val)
            <option value="{{ $key }}" {{ old('estado', $pedido->estado) == $key ? 'selected' : '' }}>
              {{ $val }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-6 col-md-1 order-2 order-md-6">
        <label for="cotizado"
          class="{{ $utilidad ? '' : 'text-white' }}">{{ $utilidad ? 'Cotizado $' : '.' }}</label>
        <input type="number" class="form-control form-control-sm text-center fixFloat" min="0" step="0.0001"
          name="cotizado" id="cotizado" value="{{ old('cotizado', $pedido->cotizado) ?? '0.00' }}"
          {{ $utilidad ? '' : 'readonly' }}>
      </div>
    </div>
  </section>

  <hr style="border-width: 3px;">

  @include('Produccion.Formularios.'.session("userInfo.empresa_tipo"))

  <hr style="border-width: 3px;">

  <section id="obsevaciones">
    <div class="form-group">
      <label for="notas"><i class="far fa-sticky-note"></i> Observaciones</label>
      <textarea class="form-control form-control-sm" name="notas" id="notas"
        rows="2">{{ old('notas', $pedido->notas) }}</textarea>
    </div>
  </section>
</div>

@section('modals1')
  <x-add-contacto />
@endsection

@section('after.scripts')
  <script>
    // const route = `{{ route('contacto.info') }}`;
    const routeCliente = `{{ route('cliente.info') }}`;
    const getPhone = () => {
      axios.post(routeCliente, {
        cliente_id: $('#cliente_id').val(),
      }).then(res => {
        let data = res.data
        $('#telefono').val(data.movil);
      }).catch(error => {
        swal('Oops!', 'No hemos podido cargar los datos del cliente', 'error');
        console.log(error);
      });
    }

    $('#cliente_id').change(() => getPhone());

    const old_cliente = `{{ old('cliente_id', $pedido->cliente_id) ?? null }}`;
    $(() => {
      if (old_cliente) getPhone()
    });
  </script>

  @yield('after.after.scripts')
@endsection
