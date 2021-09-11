<!-- Modal -->
<div class="modal fade" id="modalPedido" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Ver Pedido ID</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
      <div class="modal-body" id="modalContent">
        {{-- @include('Produccion.formPedido') --}}
      </div>
      <div class="modal-footer">
        <a class="fas fa-print" id="printer" data-target="modalContent"></a>
      </div>
    </div>
  </div>
</div>

@push('component-script')
<script>
  const routeAjax = `{{ route('pedido.modal') }}`;
  const modal = $("#modalPedido");
  const getModal = pedido_id => {
    axios.post(routeAjax, {
      pedido_id: pedido_id
    }).then(res => {
      let data = res.data;
      debugger;
      modal.find(".modal-body").html(data);
      $("#tinta_tiro").select2({
        maximumSelectionLength: 4
      });
      $("#tinta_retiro").select2({
        maximumSelectionLength: 4
      });
      // $("#modalPedido").modal("show");
    }).catch(error => {
      modal.find(".modal-body").modal("hide");
      swal('Oops!', 'No hemos podido cargar el contenido', 'error');
      console.log(error);
    })
  }

  $('#modalPedido').on('show.bs.modal', event => {
    let pedido_id = $(event.relatedTarget).data("modaldata");
    modal.find(".modal-body").empty();
    getModal(pedido_id);
  });
</script>
@endpush
