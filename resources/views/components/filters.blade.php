<x-blue-board title='Filtros' :foot="[]" class="d-print-none">
  <div class="form-row">
    <div class="col-6 col-md form-group">
      <label for="inicio">Fecha inicial</label>
      <input type="date" name="inicio" id="inicio" class="form-control form-control-sm refresh"
        value="{{ date('Y-m-') . '01' }}">
    </div>
    <div class="col-6 col-md form-group">
      <label for="fin">Fecha final</label>
      <input type="date" name="fin" id="fin" class="form-control form-control-sm refresh" value="{{ date('Y-m-d') }}">
    </div>

    @if ($cli)
      <div class="col-12 col-md form-group">
        <x-cliente />
      </div>
    @endif

    @if ($cob)
      <div class="col-6 col-md form-group">
        <label for="cobro">Cobro</label>
        <select class="form-control form-control-sm refresh" name="cobro" id="cobro">
          <option value="none" selected>Todo</option>
          @foreach (config('factura.estado') as $key => $val)
            <option value="{{ $key }}">
              {{ $val }}</option>
          @endforeach
        </select>
      </div>
    @endif

    {{ $slot }}
  </div>
</x-blue-board>
