<!-- Modal Buscar -->
<div class="modal fade" id="modalBuscar" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Buscar Pedido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('pedido.buscar') }}" method="GET">
        <div class="modal-body">
          <input type="number" class="form-control w-100" name="pedido_num">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
      </form>
    </div>
  </div>
</div>
