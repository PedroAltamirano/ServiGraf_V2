<section id="datos-personales">
  <h6 class="font-weight-bold">Datos Personales</h6>
  <hr>
  <div class="row">
    <div class="form-group col-12 col-md-2">
      <label for="foto">Foto</label>
      <input type="file" class="form-control-file dropify" name="foto" id="foto"
        data-default-file="{{ asset("avatars/$nomina->foto") }}" data-max-file-size="2M" />
    </div>
    <div class="form-row col-12 col-md-10">
      <div class="form-group col-12 col-md-2">
        <label for="fecha_nacimiento">Fecha Nacimiento</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
          class="form-control form-control-sm @error('fecha_nancimiento') is-invalid @enderror"
          value="{{ old('fecha_nacimiento', $nomina->fecha_nacimiento) ?? date('Y-m-d') }}">
      </div>
      <div class="form-group col-12 col-md-2">
        <label for="lugar_nacimiento">Lugar Nacimiento</label>
        <input type="text" id="lugar_nacimiento" name="lugar_nacimiento"
          class="form-control form-control-sm @error('lugar_nacimiento') is-invalid @enderror"
          value="{{ old('lugar_nacimiento', $nomina->lugar_nacimiento) }}">
      </div>
      <div class="form-group col-12 col-md-2">
        <label for="nacionalidad">Nacionalidad</label>
        <input type="text" id="nacionalidad" name="nacionalidad"
          class="form-control form-control-sm @error('nacionalidad') is-invalid @enderror"
          value="{{ old('nacionalidad', $nomina->nacionalidad) }}">
      </div>
      <div class="form-group col-12 col-md-2">
        <label for="estado_civil">Estado Civil</label>
        <select class="form-control form-control-sm @error('estado_civil') is-invalid @enderror" name="estado_civil"
          id="estado_civil" data-tags="true">
          <option disabled selected>Selecciona uno...</option>
          @foreach (config('nomina.estado_civil') ?? [] as $key => $value)
            <option value="{{ $key }}"
              {{ old('estado_civil', $nomina->estado_civil) == $key ? 'selected' : '' }}>{{ $value }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-12 col-md-2">
        <label for="genero">Género</label>
        <select class="form-control form-control-sm @error('genero') is-invalid @enderror" name="genero" id="genero"
          data-tags="true">
          <option disabled selected>Selecciona uno...</option>
          @foreach (config('nomina.genero') ?? [] as $key => $value)
            <option value="{{ $key }}" {{ old('genero', $nomina->genero) == $key ? 'selected' : '' }}>
              {{ $value }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-12 col-md-2">
        <label for="idioma_nativo">Idioma Nativo</label>
        <input type="text" id="idioma_nativo" name="idioma_nativo"
          class="form-control form-control-sm @error('idioma_nativo') is-invalid @enderror"
          value="{{ old('idioma_nativo', $nomina->idioma_nativo) }}">
      </div>
      <div class="form-group col-12 col-md-2">
        <label for="cedula">Cédula</label>
        <input type="text" id="cedula" name="cedula"
          class="form-control form-control-sm @error('cedula') is-invalid @enderror"
          value="{{ old('cedula', $nomina->cedula) }}">
      </div>
      <div class="form-group col-12 col-md-5">
        <label for="nombre">Nombres</label>
        <input type="text" id="nombre" name="nombre"
          class="form-control form-control-sm @error('nombre') is-invalid @enderror"
          value="{{ old('nombre', $nomina->nombre) }}">
      </div>
      <div class="form-group col-12 col-md-5">
        <label for="apellido">Apellidos</label>
        <input type="text" id="apellido" name="apellido"
          class="form-control form-control-sm @error('apellido') is-invalid @enderror"
          value="{{ old('apellido', $nomina->apellido) }}">
      </div>
      <div class="form-group col-12 col-md-2">
        <label for="telefono">Teléfono</label>
        <input type="number" id="telefono" name="telefono"
          class="form-control form-control-sm @error('telefono') is-invalid @enderror"
          value="{{ old('telefono', $nomina->telefono) }}">
      </div>
      <div class="form-group col-12 col-md-2">
        <label for="celular">Celular</label>
        <input type="number" id="celular" name="celular"
          class="form-control form-control-sm @error('celular') is-invalid @enderror"
          value="{{ old('celular', $nomina->celular) }}">
      </div>
      <div class="form-group col-12 col-md-4">
        <label for="correo">Correo</label>
        <input type="mail" id="correo" name="correo"
          class="form-control form-control-sm @error('correo') is-invalid @enderror"
          value="{{ old('correo', $nomina->correo) }}">
      </div>
      {{-- <div class="form-group col-12 col-md-5">
            <label for="cant_hijos">Cantidad de Hijos</label>
            <input type="number" id="cant_hijos" name="cant_hijos" class="form-control form-control-sm @error('cant_hijos') is-invalid @enderror" value="{{ old('cant_hijos', $nomina->cant_hijos) }}">
          </div> --}}
    </div>
  </div>
</section>
