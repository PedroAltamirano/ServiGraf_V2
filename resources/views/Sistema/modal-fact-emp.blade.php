<div id="modalFactura" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{ route('facturacion-empresas.store') }}" method="post" class="modal-path"
        enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-6 col-md-6">
              <label for="empresa">Empresa</label>
              <input type="text" name="empresa" id="empresa" class="form-control @error('empresa') is-invalid @enderror"
                value="{{ old('empresa') }}">
            </div>
            <div class="form-group col-6 col-md-6">
              <label for="representante">Representante</label>
              <input type="text" name="representante" id="representante"
                class="form-control @error('representante') is-invalid @enderror" value="{{ old('representante') }}">
            </div>
            <div class="form-group col-6 col-md-6">
              <label for="direccion">Dirección</label>
              <input type="text" name="direccion" id="direccion"
                class="form-control @error('representante') is-invalid @enderror" value="{{ old('direccion') }}">
            </div>
            <div class="form-group col-6 col-md-6">
              <label for="correo">Correo Electrónico</label>
              <input type="text" name="correo" id="correo"
                class="form-control @error('representante') is-invalid @enderror" value="{{ old('correo') }}">
            </div>
            <div class="form-group col-6 col-md-3">
              <label for="telefono">Teléfono</label>
              <input type="text" name="telefono" id="telefono"
                class="form-control @error('representante') is-invalid @enderror" value="{{ old('telefono') }}">
            </div>
            <div class="form-group col-6 col-md-3">
              <label for="celular">Celular</label>
              <input type="text" name="celular" id="celular"
                class="form-control @error('representante') is-invalid @enderror" value="{{ old('celular') }}">
            </div>

            <hr class="col-12" />

            <div class="form-group col-12 col-md-3">
              <label for="ruc">RUC</label>
              <input type="text" name="ruc" id="ruc" class="form-control @error('ruc') is-invalid @enderror"
                value="{{ old('ruc') }}">
            </div>
            <div class="form-group col-6 col-md-3">
              <label for="valido_de">Inicio de Actividades</label>
              <input type="date" value="{{ date('Y-m-d') }}" name="valido_de" id="valido_de"
                class="form-control @error('valido_de') is-invalid @enderror" value="{{ old('valido_de') }}">
            </div>
            {{-- <div class="form-group col-6 col-md-3">
              <label for="valido_a">Cese de Actividades</label>
              <input type="date" value="{{ date('Y-m-d') }}" name="valido_a" id="valido_a" class="form-control modal-valido_a @error('valido_a') is-invalid @enderror" value="{{ old('valido_a') }}">
            </div> --}}
            <div class="form-group col-6 col-md-3">
              <label for="clave_sri">Clave SRI</label>
              <input type="text" name="clave_sri" id="clave_sri"
                class="form-control @error('clave_sri') is-invalid @enderror" value="{{ old('clave_sri') }}">
            </div>
            <div class="form-group col-6 col-md-6">
              <label for="clave_firma_sri">Clave de Firma</label>
              <input type="text" name="clave_firma_sri" id="clave_firma_sri"
                class="form-control @error('clave_sri') is-invalid @enderror" value="{{ old('clave_firma_sri') }}">
            </div>
            <div class="form-group">
              <label for="firma_electronica">Firma Electrónica</label>
              <input type="file" class="form-control-file" name="firma_electronica" id="firma_electronica">
            </div>
            <div class="form-group col-6 col-md-3">
              <label for="caja">Caja</label>
              <input type="text" name="caja" id="caja" class="form-control @error('caja') is-invalid @enderror"
                value="{{ old('caja') }}">
            </div>
            <div class="form-group col-6 col-md-3">
              <label for="inicio">Inicio de facturas</label>
              <input type="text" name="inicio" id="inicio" class="form-control @error('inicio') is-invalid @enderror"
                value="{{ old('inicio') }}">
            </div>
            <div class="form-group col-6 col-md-2">
              <label for="iva_id">Iva</label>
              <select class="form-control" name="iva_id" id="iva_id">
                @foreach ($ivas as $iva)
                  <option value="{{ $iva->id }}" {{ old('iva_id') == $iva->id ? 'selected' : '' }}>
                    {{ $iva->porcentaje }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-6 col-md-2">
              <label for="ret_iva_id">Ret. Iva</label>
              <select class="form-control" name="ret_iva_id" id="ret_iva_id">
                @foreach ($ret_iva as $ret)
                  <option value="{{ $ret->id }}" {{ old('ret_iva_id') == $ret->id ? 'selected' : '' }}>
                    {{ $ret->porcentaje }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-6 col-md-2">
              <label for="ret_fnt_id">Ret. Fuente</label>
              <select class="form-control" name="ret_fuente_id" id="ret_fnt_id">
                @foreach ($ret_fnt as $ret)
                  <option value="{{ $ret->id }}" {{ old('ret_fuente_id') == $ret->id ? 'selected' : '' }}>
                    {{ $ret->porcentaje }}</option>
                @endforeach
              </select>
            </div>

            <hr class="col-12" />

            <div class="form-group col-6 col-md-2">
              <label for="impresion">Impresión</label>
              <select name="impresion" id="impresion" class="form-control @error('impresion') is-invalid @enderror">
                @foreach (config('empresa.impresion') as $key => $val)
                  <option value="{{ $key }}" {{ old('impresion') == $key ? 'selected' : '' }}>
                    {{ $val }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-2">
              <label for="statusDiv">Activo</label>
              <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
                <input type="checkbox" class="custom-control-input @error('status') is-invalid @enderror" id="status"
                  name="status" value="1" {{ old('status') == '1' ? 'checked' : '' }}>
                <label class="custom-control-label" for="status"></label>
              </div>
            </div>
            <div class="form-group col-12">
              <label for="logo">Logo <span class="text-muted">Max. 2MB</span></label>
              <input type="file" class="dropify" id="logo" name="logo" title="logo del usuario" accept="image/*"
                data-max-file-size="3M" data-default-file=''>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary submitbtn">Crear</button>
        </div>
      </form>
    </div>
  </div>
</div>
