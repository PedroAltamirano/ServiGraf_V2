<section id="datos-domiciliarios">
  <h6 class="font-weight-bold">Datos Domiciliarios</h6>
  <hr>
  <div class="row">
    <div class="form-group col-12 col-md-6">
      <label for="direccion">Dirección</label>
      <input type="text" id="direccion" name="direccion"
        class="form-control form-control-sm @error('direccion') is-invalid @enderror"
        value="{{ old('direccion', $nomina->direccion) }}">
    </div>
    <div class="form-group col-12 col-md-2">
      <label for="sector">Sector</label>
      <input type="text" id="sector" name="sector"
        class="form-control form-control-sm @error('sector') is-invalid @enderror"
        value="{{ old('sector', $nomina->sector) }}">
    </div>
    <div class="form-group col-3 col-md-2 text-center">
      <label for="statusDiv">Visita Domiciliaria</label>
      <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
        <input type="checkbox" class="custom-control-input @error('visita_domiciliaria') is-invalid @enderror"
          id="visita_domiciliaria" name="visita_domiciliaria"
          {{ old('visita_domiciliaria', $nomina->visita_domiciliaria) == '1' ? 'checked' : '' }} value='1'>
        <label class="custom-control-label" for="visita_domiciliaria"></label>
      </div>
    </div>
    <div class="form-group col-12 col-md-2">
      <label for="fecha_visita">Fecha Visita</label>
      <input type="date" name="fecha_visita" id="fecha_visita"
        class="form-control form-control-sm @error('fecha_visita') is-invalid @enderror"
        value="{{ old('fecha_visita', $nomina->fecha_visita) }}">
    </div>
  </div>
</section>
