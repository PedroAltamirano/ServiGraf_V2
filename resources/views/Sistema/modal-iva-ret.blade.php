<!-- Modal Ivas -->
<div class="modal fade" id="modalIva" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Iva</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form action="" class="modal-path" method="POST">
        @csrf
        @method('POST')
        <div class="modal-body">
          <div class="form-group">
            <label for="porcentaje-iva">Porcentaje</label>
            <input type="number" step="0.01" name="porcentaje" id="porcentaje-iva" class="form-control fixFloat">
          </div>
          <div class="form-group col-2">
              <label for="statusDiv">Activo</label>
              <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
                <input type="checkbox" class="custom-control-input" id="status-iva" name="status" value="1" {{ old('status') == '1' ? 'checked':'' }}>
                <label class="custom-control-label" for="status-iva"></label>
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

<!-- Modal Retenciones -->
<div class="modal fade" id="modalRetencion" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form action="" class="modal-path" method="POST">
        @csrf
        @method('POST')
        <div class="modal-body">
          <div class="form-group">
            <label for="porcentaje">Porcentaje</label>
            <input type="number" step="0.01" name="porcentaje" id="porcentaje-ret" class="form-control fixFloat">
          </div>
          <div class="form-group">
            <label for="tipo">Tipo de retención</label>
            <select class="form-control" name="tipo" id="tipo">
              <option value="1">Iva</option>
              <option value="0">Fuente</option>
            </select>
          </div>
          <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
          </div>
          <div class="form-group col-2">
              <label for="statusDiv">Activo</label>
              <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
                <input type="checkbox" class="custom-control-input" id="status-ret" name="status" value="1" {{ old('status') == '1' ? 'checked':'' }}>
                <label class="custom-control-label" for="status-ret"></label>
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
