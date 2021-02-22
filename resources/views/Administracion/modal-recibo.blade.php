<div class="modal fade" id="modalRecibo" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Recibo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <x-recibo />
        <div style="height: 100px"></div>
        <x-recibo />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Imprimir</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalLibro" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuevo Libro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('libro.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="usuario_id">Usuario</label>
            <select class="form-control" name="usuario_id" id="usuario_id">
              @foreach ($usuarios as $item)
              <option value="{{ $item->cedula }}">{{ $item->usuario }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="libro">Libro</label>
            <input type="text" name="libro" id="libro" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Crear</button>
        </div>
      </form>
    </div>
  </div>
</div>
