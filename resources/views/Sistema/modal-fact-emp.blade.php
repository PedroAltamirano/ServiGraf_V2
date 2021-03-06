<!-- Modal CATEGORIA -->
<div id="modalFactura" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{ route('facturacion-empresas.store') }}" method="post" class="modal-path" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-6 col-md-6">
              <label for="empresa">Empresa</label>
              <input type="text" name="empresa" id="empresa" class="form-control modal-empresa @error('empresa') is-invalid @enderror" value="{{ old('empresa') }}">
            </div>
            <div class="form-group col-6 col-md-6">
              <label for="representante">Representante</label>
              <input type="text" name="representante" id="representanteModal" class="form-control modal-representante @error('representante') is-invalid @enderror" value="{{ old('representante') }}">
            </div>
            <div class="form-group col-12 col-md-6">
              <label for="ruc">RUC</label>
              <input type="text" name="ruc" id="rucModal" class="form-control modal-ruc @error('ruc') is-invalid @enderror" value="{{ old('ruc') }}">
            </div>
            <div class="form-group col-6 col-md-3">
              <label for="caja">Caja</label>
              <input type="text" name="caja" id="caja" class="form-control modal-caja @error('caja') is-invalid @enderror" value="{{ old('caja') }}">
            </div>
            <div class="form-group col-6 col-md-3">
              <label for="inicio">Inicio</label>
              <input type="text" name="inicio" id="inicioModal" class="form-control modal-inicio @error('inicio') is-invalid @enderror" value="{{ old('inicio') }}">
            </div>
            <div class="form-group col-6 col-md-6">
              <label for="valido_de">Válido de</label>
              <input type="date" value="{{ date('Y-m-d') }}" name="valido_de" id="valido_de" class="form-control modal-valido_de @error('valido_de') is-invalid @enderror" value="{{ old('valido_de') }}">
            </div>
            <div class="form-group col-6 col-md-6">
              <label for="valido_a">Válido a</label>
              <input type="date" value="{{ date('Y-m-d') }}" name="valido_a" id="valido_a" class="form-control modal-valido_a @error('valido_a') is-invalid @enderror" value="{{ old('valido_a') }}">
            </div>
            <div class="form-group col-6 col-md-2">
              <label for="iva_id">Iva</label>
              <select class="form-control modal-iva_id" name="iva_id" id="iva_id">
                @foreach ($ivas as $iva)
                <option value="{{ $iva->id }}" {{ old('iva_id') == $iva->id ? 'selected' : '' }}>{{ $iva->porcentaje }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-6 col-md-2">
              <label for="ret_iva_id">Ret. Iva</label>
              <select class="form-control modal-ret_iva_id" name="ret_iva_id" id="ret_iva_id">
                @foreach ($ret_iva as $ret)
                <option value="{{ $ret->id }}" {{ old('ret_iva_id') == $ret->id ? 'selected' : '' }}>{{ $ret->porcentaje }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-6 col-md-2">
              <label for="ret_fnt_id">Ret. Fuente</label>
              <select class="form-control modal-ret_fuente_id" name="ret_fuente_id" id="ret_fnt_id">
                @foreach ($ret_fnt as $ret)
                <option value="{{ $ret->id }}" {{ old('ret_fuente_id') == $ret->id ? 'selected' : '' }}>{{ $ret->porcentaje }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-6 col-md-2">
              <label for="impresion">Impresión</label>
              <select name="impresion" id="impresion" class="form-control modal-impresion @error('impresion') is-invalid @enderror">
                <option value="1" {{ old('impresion') == '1' ? 'selected' : '' }}>A4</option>
                <option value="0" {{ old('impresion') == '0' ? 'selected' : '' }}>A5</option>
              </select>
            </div>
            <div class="form-group col-2">
              <label for="statusDiv">Activo</label>
              <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
                <input type="checkbox" class="custom-control-input modal-activo @error('status') is-invalid @enderror" id="status" name="status" value="1" {{ old('status') == '1' ? 'checked':'' }}>
                <label class="custom-control-label" for="status"></label>
              </div>
            </div>
            <div class="form-group col-12">
              <label for="logo">Logo <span class="text-muted">Max. 2MB</span></label>
              <input type="file" class="dropify modal-logo" id="logo" name="logo" title="logo del usuario" accept="image/*" size="2MB" data-default-file=''>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
