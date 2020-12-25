<div class="modal fade" id="modalProveedor" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crear proveedor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('proveedor.store') }}" method="POST" id="proveedorForm">
          @csrf
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="proveedor" id="proveedor_nombre">
          </div>
          <div class="form-group">
            <label for="telefono">Telefono</label>
            <input type="text" class="form-control" name="telefono" id="proveedor_telefono">
          </div>
          <div class="form-group">
            <label for="direccion">Direccion</label>
            <input type="text" class="form-control" name="direccion" id="proveedor_direccion">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary submitbtn" data-form="#proveedorForm">Guardar</button>
      </div>
    </div>
  </div>
</div>
