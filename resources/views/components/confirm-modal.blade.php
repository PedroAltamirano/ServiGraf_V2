<!-- Password confirm Modal-->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirma tu contraseña</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="#" id="confirmForm" method="POST">
        @csrf
        <div class="modal-body">
        <div class="container">
            <div class="form-group">
              <label for="password" class="form-label">Contraseña</label>
              <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" required>
              </div>
            </div>
        </div>
        </div>
        <div class="modal-footer">
          <button class="btn bg-light" type="button" data-dismiss="modal">Cancelar</button>
          <button class="btn btn-primary confirm-form" type="submit">Continuar</button>
        </div>
      </form>
    </div>
  </div>
</div>
