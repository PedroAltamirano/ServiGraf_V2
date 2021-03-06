<!-- Modal Ivas -->
<div class="modal fade" id="modalIva" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-iva-title">Iva</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form action="" class="modal-iva-path" method="POST">
        @csrf
        @method('POST')
        <div class="modal-body">
          <div class="form-group">
            <label for="porcentaje">Porcentaje</label>
            <input type="number" step="0.01" name="porcentaje" id="porcentaje" class="form-control fixFloat modal-iva-porcentaje">
          </div>
          <div class="form-group col-2">
              <label for="statusDiv">Activo</label>
              <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
                <input type="checkbox" class="custom-control-input modal-iva-activo" id="status-iva" name="status" value="1" {{ old('status') == '1' ? 'checked':'' }}>
                <label class="custom-control-label" for="status-iva"></label>
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

<!-- Modal Retenciones -->
<div class="modal fade" id="modalRetencion" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-ret-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form action="" class="modal-ret-path" method="POST">
        @csrf
        @method('POST')
        <div class="modal-body">
          <div class="form-group">
            <label for="porcentaje">Porcentaje</label>
            <input type="number" step="0.01" name="porcentaje" id="porcentaje" class="form-control fixFloat modal-ret-porcentaje">
          </div>
          <div class="form-group">
            <label for="tipo">Tipo de retención</label>
            <select class="form-control modal-ret-tipo" name="tipo" id="tipo">
              <option value="1">Iva</option>
              <option value="0">Fuente</option>
            </select>
          </div>
          <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <textarea class="form-control modal-ret-descripcion" name="descripcion" id="descripcion" rows="3"></textarea>
          </div>
          <div class="form-group col-2">
              <label for="statusDiv">Activo</label>
              <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
                <input type="checkbox" class="custom-control-input modal-ret-activo" id="status-ret" name="status" value="1" {{ old('status') == '1' ? 'checked':'' }}>
                <label class="custom-control-label" for="status-ret"></label>
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
