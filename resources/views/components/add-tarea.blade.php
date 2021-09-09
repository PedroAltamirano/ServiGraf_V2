<div class="modal fade" id="modalTarea" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nueva Tarea</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('crm.store') }}" id="tareaForm" method="post">
          @csrf
          @method('POST')
          <section id="datos-contacto">
            <h6><i class="fas fa-plus" data-toggle="modal" data-target="#modalContacto"></i>&nbsp; Datos del contacto</h6>
            <hr>
            <div class="form-row">
              <div class="form-group col-12 col-md-6">
                <label for="contacto_id">Contacto</label>
                <select class="form-control form-control-sm @error('contacto_id') is-invalid @enderror select2Class" name="contacto_id" id="contacto_id" data-tags="true">
                  <option disabled selected>Selecciona uno...</option>
                  @foreach ($empresas as $item)
                    <optgroup label="{{ $item->nombre }}">
                      @foreach ($item->contactos as $item)
                      <option value="{{ $item->id }}" {{ old('actividad_id') == $item->id ? 'selected' : '' }}>{{ $item->full_name }}</option>
                      @endforeach
                    </optgroup>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-12 col-md-6">
                <label for="organizacion">Organización</label>
                <input type="text" id="task_organizacion" class="form-control form-control-sm" value="{{ old('organizacion') }}" readonly>
              </div>
              <div class="form-group col-12 col-md-4">
                <label for="telefono">Telefono</label>
                <input type="text" id="task_telefono" class="form-control form-control-sm" value="{{ old('telefono') }}" readonly>
              </div>
              <div class="form-group col-12 col-md-4">
                <label for="email">Email</label>
                <input type="text" id="task_email" class="form-control form-control-sm" value="{{ old('email') }}" readonly>
              </div>
              <div class="form-group col-12 col-md-4">
                <label for="direccion">Dirección</label>
                <input type="text" id="task_direccion" class="form-control form-control-sm" value="{{ old('direccion') }}" readonly>
              </div>
            </div>
          </section>

          <hr style="border-width: 3px;">

          <section id="tarea">
            <div class="form-row">
              <div class="form-group col-12 col-md-6">
                <label for="actividad_id">Actividad</label>
                <select class="form-control form-control-sm  @error('actividad_id') is-invalid @enderror" name="actividad_id" id="actividad_id">
                  <option disabled selected>Selecciona uno</option>
                  @foreach ($actividades as $item)
                  <option value="{{ $item->id }}" {{ old('actividad_id') == $item->id ? 'selected' : '' }}>{{ $item->nombre }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-12 col-md-6">
                <label for="asignado_id">Asignar a</label>
                <select class="form-control form-control-sm  @error('asignado_id') is-invalid @enderror" name="asignado_id" id="asignado_id">
                  <option disabled selected>Selecciona uno</option>
                  @foreach ($usuarios as $item)
                  <option value="{{ $item->cedula }}" {{ old('asignado_id') == $item->id ? 'selected' : '' }}>{{ $item->usuario }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-12 col-md-4">
                <label for="estado">Estado</label>
                <select class="form-control form-control-sm  @error('estado') is-invalid @enderror" name="estado" id="estado">
                  <option disabled selected>Selecciona uno</option>
                  @foreach (config('crm.status') ?? [] as $key => $val)
                  <option value="{{ $key }}" {{ old('estado') == $key ? 'selected' : '' }}>{{ $val }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-12 col-md-4">
                <label for="fecha">Fecha</label>
                <input type="date" class="form-control form-control-sm  @error('fecha') is-invalid @enderror" name="fecha" id="fecha" value="{{ old('fecha') }}">
              </div>
              <div class="form-group col-12 col-md-4">
                <label for="hora">Hora</label>
                <input type="time" class="form-control form-control-sm  @error('hora') is-invalid @enderror" name="hora" id="hora" value="{{ old('hora') }}">
              </div>
              <div class="form-group col-12">
                <label for="nota">Nota</label>
                <textarea class="form-control form-control-sm  @error('nota') is-invalid @enderror" name="nota" id="nota" rows="3">{{ old('nota') }}</textarea>
              </div>
            </div>
          </section>
        </form>
      </div>
      <div class="modal-footer">
        {{-- <button type="button" class="btn btn-secondary">Agendar</button> --}}
        <button type="button" class="btn btn-primary submitbtn" data-form="#tareaForm">Crear</button>
      </div>
    </div>
  </div>
</div>

@push('component-script')
<script>
  const path = `{{ route('contacto.info') }}`;
  const fill_contact = () => {
    axios.post(path, {
      contacto_id: $('#contacto_id').val()
    }).then(function (res) {
      var data = res.data;
      $("#task_organizacion").val(data.empresa.nombre);
      $("#task_telefono").val(data.movil);
      $("#task_email").val(data.email);
      $("#task_direccion").val(data.direccion);
    }).catch(error => {
      console.log(error);
    });
  }

  $('#contacto_id').change(event => fill_contact())
</script>
@endpush
