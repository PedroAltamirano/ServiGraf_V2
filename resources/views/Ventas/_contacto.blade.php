{{-- DATOS DE LA EMPRESA --}}
<div class="form-row">
  <div class="form-group col-12 col-md-6">
    <label for="empresa">Empresa</label>
    <div>
      <input type="text" class="form-control form-control-sm @error('empresa') is-invalid @enderror" name="empresa"
        id="empresa" value="{{ old('empresa', $empresa->nombre) }}">
    </div>
  </div>
  <div class="form-group col-12 col-md-3">
    <label for="ruc">RUC</label>
    <input type="number" class="form-control form-control-sm @error('ruc') is-invalid @enderror" name="ruc" id="ruc"
      value="{{ old('ruc', $empresa->ruc) }}">
  </div>
  <div class="form-group col-12 col-md-3">
    <label for="actividad">Actividad</label>
    <input type="text" class="form-control form-control-sm @error('actividad') is-invalid @enderror" name="actividad"
      id="actividad" value="{{ old('actividad', $contacto->actividad) }}">
  </div>
</div>

{{-- DATOS DEL CONTACTO --}}
<div class="form-row">
  <div class="form-group col-5 col-sm-1">
    <label for="titulo">Titulo</label>
    <input type="text" class="form-control form-control-sm @error('titulo') is-invalid @enderror" name="titulo"
      id="titulo" value="{{ old('titulo', $contacto->titulo) }}">
  </div>
  <div class="form-group col-12 col-md-4">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control form-control-sm @error('nombre') is-invalid @enderror" name="nombre"
      id="nombre" value="{{ old('nombre', $contacto->nombre) }}">
  </div>
  <div class="form-group col-12 col-md-4">
    <label for="apellido">Apellido</label>
    <input type="text" class="form-control form-control-sm @error('apellido') is-invalid @enderror" name="apellido"
      id="apellido" value="{{ old('apellido', $contacto->apellido) }}">
  </div>
  <div class="form-group col-7 col-sm-3">
    <label for="cargo">Cargo</label>
    <input type="text" class="form-control form-control-sm @error('cargo') is-invalid @enderror" name="cargo" id="cargo"
      value="{{ old('cargo', $contacto->cargo) }}">
  </div>
  <div class="form-group col-12 col-md-6">
    <label for="direccion">Direccion</label>
    <input type="text" class="form-control form-control-sm @error('direccion') is-invalid @enderror" name="direccion"
      id="direccion" value="{{ old('direccion', $contacto->direccion) }}">
  </div>
  <div class="form-group col-12 col-md-2">
    <label for="sector">Sector</label>
    <input type="text" class="form-control form-control-sm @error('sector') is-invalid @enderror" name="sector"
      id="sector" value="{{ old('sector', $contacto->sector) }}">
  </div>
  <div class="form-group col-12 col-md-4">
    <label for="email">Email</label>
    <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email"
      id="email" value="{{ old('email', $contacto->email) }}">
  </div>
  <div class="form-group col-12 col-md-3">
    <label for="telefono">Telefono</label>
    <input type="number" class="form-control form-control-sm @error('telefono') is-invalid @enderror" name="telefono"
      id="telefono" max="9999999" value="{{ old('telefono', $contacto->telefono) }}">
  </div>
  <div class="form-group col-12 col-md-1">
    <label for="extencion">Extencion</label>
    <input type="number" class="form-control form-control-sm @error('extension') is-invalid @enderror" name="extencion"
      id="extencion" value="{{ old('extension', $contacto->extension) }}">
  </div>
  <div class="form-group col-12 col-md-3">
    <label for="celular">Celular</label>
    <input type="number" class="form-control form-control-sm @error('celular') is-invalid @enderror" name="celular"
      id="celular" max="0999999999" value="{{ old('celular', $contacto->celular) }}">
  </div>
  <div class="form-group col-12 col-md-5">
    <label for="web">Web</label>
    <input type="url" class="form-control form-control-sm @error('web') is-invalid @enderror" name="web" id="web"
      value="{{ old('web', $contacto->web) }}">
  </div>
  <div class="form-group col-6 col-md-2">
    <div class="form-check">
      <input type="checkbox" class="form-check-input @error('isCliente') is-invalid @enderror" name="isCliente"
        id="isCliente" value="0" {{ old('isCliente', $contacto->isCliente) ? 'checked' : '' }}>
      <label class="form-check-label" for="isCliente">Cliente</label>
    </div>
  </div>
  <div class="form-group">
    <label for="tipo_contribuyente">Tipo de contribuyente</label>
    <select class="form-control" name="tipo_contribuyente" id="tipo_contribuyente">
      @foreach (config('factura.tipo_contribuyente') as $key => $val)
        <option value="{{ $key }}"
          {{ old('tipo_contribuyente', $contacto->tipo_contribuyente) ? 'selected' : '' }}>{{ $val }}
        </option>
      @endforeach
    </select>
  </div>
  <div class="form-group col-6 col-md-2">
    <div class="form-check">
      <input type="checkbox" class="form-check-input @error('seguimiento') is-invalid @enderror" name="seguimiento"
        id="seguimiento" value="0" {{ old('seguimiento', $contacto->seguimiento) ? 'checked' : '' }}>
      <label class="form-check-label" for="seguimiento">Seguimiento</label>
    </div>
  </div>
</div>
