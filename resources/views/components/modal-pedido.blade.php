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
        @include('Produccion.formPedido')
      </div>
      <div class="modal-footer">
        <a class="fas fa-print" id="printer" data-target="modalContent"></a>
      </div>
    </div>
  </div>
</div>

@push('component-script')
<script>
  const routeAjax = `{{ route('pedido.modal', 0) }}`;
  const modal = $("#modalPedido");

  const populate_modal = (data=null) => {
    let pedido = data.pedido;
    let tintas = data.tintas;
    let materiales = data.materiales;
    let procesos = data.procesos;

    modal.find('.modal-title').html(`Ver Pedido ${pedido.numero}`);

    // datos del cliente
    modal.find('#fecha_entrada').val(data ? pedido.fecha_entrada : '');
    modal.find('#cliente_id').val(data ? pedido.cliente_id : '').change();
    modal.find('#prioridad').val(data ? pedido.prioridad : '');
    modal.find('#estado').val(data ? pedido.estado : '');
    modal.find('#cotizado').val(data ? pedido.cotizado : '');
    // descripcion del trabajo
    modal.find('#detalle').val(data ? pedido.detalle : '');
    modal.find('#papel').val(data ? pedido.papel : '');
    modal.find('#cantidad').val(data ? pedido.cantidad : '');
    modal.find('#corte_ancho').val(data ? pedido.corte_ancho : '');
    modal.find('#corte_alto').val(data ? pedido.corte_alto : '');
    // tintas
    modal.find('#numerado_inicio').val(data ? pedido.numerado_inicio : '');
    modal.find('#numerado_fin').val(data ? pedido.numerado_fin : '');
    // materiales
    modal.find('#total_material').val(data ? pedido.total_material : '');
    // procesos
    modal.find('#total_pedido').val(data ? pedido.total_pedido : '');
    modal.find('#abono').val(data ? pedido.abono : '');
    modal.find('#saldo').val(data ? pedido.saldo : '');
    // notas
    modal.find('#notas').val(data ? pedido.notas : '');

    // tintas tiro
    let tiro = tintas.filter(item => item.lado == '1').map(item => Number(item.tinta_id));
    change_select('#modalPedido #tinta_tiro', tiro);
    // tintas retiro
    let retiro = tintas.filter(item => item.lado == '0').map(item => item.tinta_id);
    change_select('#modalPedido #tinta_retiro', tiro);

    materiales.map(item => {
      add_material(item.material_id, item.cantidad, item.corte_alto, item.corte_ancho, item.tamanos, item.proveedor_id, item.factura, item.total);
    });

    procesos.map(item => {
      add_proceso(item.proceso_id, item.tiro, item.retiro, item.millares, item.valor_unitario, item.total, item.status);
    });
  }

  const getModal = pedido_id => {
    axios
    .get(routeAjax.replace('/0', `/${pedido_id}`))
    .then(res => {
      let data = res.data;
      populate_modal(data);
    }).catch(error => {
      modal.modal("hide");
      populate_modal();
      swal('Oops!', 'No hemos podido cargar el contenido', 'error');
      console.log(error);
    })
  }

  $('#modalPedido').on('show.bs.modal', event => {
    let pedido_id = $(event.relatedTarget).data("modaldata");
    getModal(pedido_id);
  });
</script>
@endpush
