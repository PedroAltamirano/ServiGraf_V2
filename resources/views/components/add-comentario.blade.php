<!-- Modal comentario -->
<div class="modal fade" id="modalComentario" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('comentario.store') }}" role="form" id="form">
        @csrf
        @method('POST')
        <div class="modal-body">
          <input type="hidden" name="parent_id" id="parent_id">
          <input type="hidden" name="contacto_id" id="contacto_id" value="{{ $contactoId }}">
          <div class="form-group">
            <label for="asignado_id">Asignar a:</label>
            <select class="form-control" name="asignado_id" id="asignado_id">
              <option value="">Selecciona</option>
              @foreach ($usuarios as $item)
              <option value="{{ $item->cedula }}">{{ $item->usuario }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="comentario">Comentario</label>
            <input type="text" class="form-control @error('comentario') is-invalid @enderror" name="comentario"
              id="comentario" value="{{ old('comentario') }}" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary submitbtn">Crear</button>
        </div>
      </form>
    </div>
  </div>
</div>

@push('component-script')
<script>
  const routeStoreComentario = `{{ route('comentario.store') }}`;
  const routeEditComentario = `{{ route('comentario.update', 0) }}`;
  $('#modalComentario').on('show.bs.modal', event => {
    let data = $(event.relatedTarget).data('modaldata');
    let parent_id = $(event.relatedTarget).data('parent_id');
    let modal = $(event.target);

    let path = data ? routeEditComentario.replace('/0', `/${data.id}`) : routeStoreComentario;
    modal.find('#form').attr('action', path);
    modal.find("input[name='_method']").val(data ? 'PUT' : 'POST');
    modal.find(".submitbtn").html(data ? 'Modificar' : 'Crear');

    modal.find('#parent_id').val(data ? data.parent_id : parent_id);
    modal.find('#asignado_id').val(data ? data.asignado_id : '').prop('disabled', (data ? 'disabled' : ''));
    modal.find('#comentario').val(data ? data.comentario : '');
  });
</script>
@endpush
