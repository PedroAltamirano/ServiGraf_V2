<section id="datos-empresariales" class="mt-3">
  <h6 class="font-weight-bold">Datos Empresariales</h6>
  <hr>
  <div class="form-row">
    <div class="form-group col-12 col-md-2">
      <label for="inicio_labor">Inicio Labores</label>
      <input type="date" name="inicio_labor" id="inicio_labor"
        class="form-control form-control-sm @error('inicio_labor') is-invalid @enderror"
        value="{{ old('inicio_labor', $nomina->inicio_labor) ?? date('Y-m-d') }}">
    </div>
    <div class="form-group col-12 col-md-2">
      <label for="fin_labor">Fin de Labores</label>
      <input type="date" name="fin_labor" id="fin_labor"
        class="form-control form-control-sm @error('fin_labor') is-invalid @enderror"
        value="{{ old('fin_labor', $nomina->fin_labor) }}">
    </div>
    <div class="form-group col-12 col-md-2">
      <label for="cargo">Cargo</label>
      <input type="text" id="cargo" name="cargo"
        class="form-control form-control-sm @error('cargo') is-invalid @enderror"
        value="{{ old('cargo', $nomina->cargo) }}">
    </div>
    <div class="form-group col-12 col-md-2">
      <label for="sueldo">Sueldo</label>
      <input type="number" id="sueldo" name="sueldo"
        class="form-control form-control-sm @error('sueldo') is-invalid @enderror"
        value="{{ old('sueldo', $nomina->sueldo) }}">
    </div>
    <div class="form-group col-12 col-md-2 text-center">
      <label for="statusDiv">Activo</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('status') is-invalid @enderror" id="status"
          name="status" {{ old('status', $nomina->status) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="status"></label>
      </div>
    </div>
    <div class="form-group col-12 col-md-2">
      <label for="centro_costos_id">Centro de Costos</label>
      <select class="form-control form-control-sm @error('centro_costos_id') is-invalid @enderror"
        name="centro_costos_id" id="centro_costos_id">
        <option disabled selected>Selecciona uno...</option>
        @foreach ($ccostos as $item)
          <option value="{{ $item->id }}"
            {{ old('centro_costos_id', $nomina->centro_costos_id) == $item->id ? 'selected' : '' }}>
            {{ $item->nombre }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-12 col-md-2">
      <label for="ingreso_iess">Ingreso Iess</label>
      <input type="date" name="ingreso_iess" id="ingreso_iess"
        class="form-control form-control-sm @error('ingreso_iess') is-invalid @enderror"
        value="{{ old('ingreso_iess', $nomina->ingreso_iess) ?? date('Y-m-d') }}">
    </div>
    <div class="form-group col-3 col-md-2 text-center">
      <label for="statusDiv">Iess Asumido por el Empleador</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('iess_asumido_empleador') is-invalid @enderror"
          id="iess_asumido_empleador" name="iess_asumido_empleador"
          {{ old('iess_asumido_empleador', $nomina->iess_asumido_empleador) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="iess_asumido_empleador"></label>
      </div>
    </div>
    <div class="form-group col-3 col-md-2 text-center">
      <label for="statusDiv">Liquidación Mensual</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('liquidacion_mensual') is-invalid @enderror"
          id="liquidacion_mensual" name="liquidacion_mensual"
          {{ old('liquidacion_mensual', $nomina->liquidacion_mensual) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="liquidacion_mensual"></label>
      </div>
    </div>
    <div class="form-group col-3 col-md-2 text-center">
      <label for="statusDiv">Trabajo por Horas</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('Txhoras') is-invalid @enderror" id="Txhoras"
          name="Txhoras" {{ old('Txhoras', $nomina->Txhoras) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="Txhoras"></label>
      </div>
    </div>
    <div class="col-4"></div>
    <div class="form-group col-12 col-md-2">
      <label for="horario_id">Horario</label>
      <select class="form-control form-control-sm @error('horario_id') is-invalid @enderror" name="horario_id"
        id="horario_id" data-tags="true">
        <option disabled selected>Selecciona uno...</option>
        @foreach ($horarios as $item)
          <option value="{{ $item->id }}"
            {{ old('horario_id', $nomina->horario_id) == $item->id ? 'selected' : '' }}>{{ $item->nombre }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-12 col-md-10">
      <label for="observaciones">Observaciones</label>
      <textarea class="form-control form-control-sm @error('observaciones') is-invalid @enderror" name="observaciones"
        id="observaciones" rows="1">{{ old('observaciones', $nomina->observaciones) }}</textarea>
    </div>
    <div class="form-group col-12 col-md-2">
      <label for="banco_id">Banco</label>
      <select class="form-control form-control-sm @error('banco_id') is-invalid @enderror" name="banco_id" id="banco_id"
        data-tags="true">
        <option disabled selected>Selecciona uno...</option>
        {{-- <option value="" {{ old('banco_id', $nomina->banco_id) == '' ? 'selected' : '' }}></option> --}}
        @foreach (config('nomina.bancos') ?? [] as $key => $value)
          <option value="{{ $key }}" {{ old('banco_id', $nomina->banco_id) == $key ? 'selected' : '' }}>
            {{ $value }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-12 col-md-2">
      <label for="tipo_cuenta_banco">Tipo Cuenta</label>
      <select class="form-control form-control-sm @error('tipo_cuenta_banco') is-invalid @enderror"
        name="tipo_cuenta_banco" id="tipo_cuenta_banco" data-tags="true">
        <option disabled selected>Selecciona uno...</option>
        @foreach (config('nomina.tipo_cuenta_banco') ?? [] as $key => $value)
          <option value="{{ $key }}"
            {{ old('tipo_cuenta_banco', $nomina->tipo_cuenta_banco) == $key ? 'selected' : '' }}>
            {{ $value }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-12 col-md-2">
      <label for="numero_cuenta_bancaria">Número Cuenta</label>
      <input type="text" id="numero_cuenta_bancaria" name="numero_cuenta_bancaria"
        class="form-control form-control-sm @error('numero_cuenta_bancaria') is-invalid @enderror"
        value="{{ old('numero_cuenta_bancaria', $nomina->numero_cuenta_bancaria) }}">
    </div>
  </div>
</section>
