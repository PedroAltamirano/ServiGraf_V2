<section id="datos-medicos" class="mt-3">
  <h6 class="font-weight-bold">Datos Médicos</h6>
  <hr>
  <div class="form-row">
    <div class="form-group col-12 col-md-6">
      <label for="contacto_emergencia_nombre">Contacto Emergencia Nombre</label>
      <input type="text" id="contacto_emergencia_nombre" name="contacto_emergencia_nombre"
        class="form-control form-control-sm @error('contacto_emergencia_nombre') is-invalid @enderror"
        value="{{ old('contacto_emergencia_nombre', $nomina->contacto_emergencia_nombre) }}">
    </div>
    <div class="form-group col-12 col-md-2">
      <label for="contacto_emergencia_domicilio">Domicilio</label>
      <input type="text" id="contacto_emergencia_domicilio" name="contacto_emergencia_domicilio"
        class="form-control form-control-sm @error('contacto_emergencia_domicilio') is-invalid @enderror"
        value="{{ old('contacto_emergencia_domicilio', $nomina->contacto_emergencia_domicilio) }}"
        placeholder="2222222">
    </div>
    <div class="form-group col-12 col-md-2">
      <label for="contacto_emergencia_celular">Celular</label>
      <input type="text" id="contacto_emergencia_celular" name="contacto_emergencia_celular"
        class="form-control form-control-sm @error('contacto_emergencia_celular') is-invalid @enderror"
        value="{{ old('contacto_emergencia_celular', $nomina->contacto_emergencia_celular) }}"
        placeholder="0999999999">
    </div>
    <div class="form-group col-12 col-md-2">
      <label for="contacto_emergencia_oficina">Oficina</label>
      <input type="text" id="contacto_emergencia_oficina" name="contacto_emergencia_oficina"
        class="form-control form-control-sm @error('contacto_emergencia_oficina') is-invalid @enderror"
        value="{{ old('contacto_emergencia_oficina', $nomina->contacto_emergencia_oficina) }}" placeholder="2222222">
    </div>
    <div class="form-group col-12 col-md-2">
      <label for="tipo_sangre">Tipo de Sangre</label>
      <select class="form-control form-control-sm @error('tipo_sangre') is-invalid @enderror" name="tipo_sangre"
        id="tipo_sangre" data-tags="true">
        <option disabled selected>Selecciona uno...</option>
        @foreach (config('nomina.tipo_sangre') ?? [] as $key => $value)
          <option value="{{ $key }}"
            {{ old('tipo_sangre', $nomina->tipo_sangre) == $key ? 'selected' : '' }}>{{ $value }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-12 col-md-5">
      <label for="padecimientos_medicos">Padecimientos Médicos</label>
      <textarea class="form-control form-control-sm @error('padecimientos_medicos') is-invalid @enderror"
        name="padecimientos_medicos" id="padecimientos_medicos"
        rows="1">{{ old('padecimientos_medicos', $nomina->padecimientos_medicos) }}</textarea>
    </div>
    <div class="form-group col-12 col-md-5">
      <label for="alergias">Alergias</label>
      <textarea class="form-control form-control-sm @error('alergias') is-invalid @enderror" name="alergias"
        id="alergias" rows="1">{{ old('alergias', $nomina->padecimientos_medicos) }}</textarea>
    </div>
  </div>
</section>
