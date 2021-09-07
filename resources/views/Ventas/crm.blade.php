@extends('layouts.app')

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'CRM',
      'current' => true,
      'href' => '#',
    ]
  ]"
/>

<x-blue-board
  title='Tareas'
  :foot="[
    ['text'=>'Nueva', 'href'=>'#modalTarea', 'id'=>'newTarea', 'tipo'=> 'modal'],
  ]"
>
  @if ($atrasadas->count())
  <x-aditional-info text='Atrasadas' />
  <div class="table-responsive">
    <table id="table" class="table table-striped table-sm">
      <thead>
      </thead>
      <tbody>
        @foreach ($atrasadas as $item)
        <tr>
          <td class="dateCol">{{ $item->fecha }}</td>
          <td class="dateCol">{{ $item->hora }}</td>
          <td>{{ $item->contacto_formated }}</td>
          <td>{{ $item->actividad->nombre }}</td>
          <td>{{ $item->asignado->usuario }}</td>
          <td class="crudCol">
            <x-crud :routeEdit="route('crm.edit', [$item->id])" />
          </td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
      </tfoot>
    </table>
  </div>
  @endif

  <x-aditional-info text='Hoy' />
  <div class="table-responsive">
    <table id="table" class="table table-striped table-sm">
      <thead>
      </thead>
      <tbody>
        @foreach ($hoy as $item)
        <tr>
          <td class="dateCol">{{ $item->fecha }}</td>
          <td class="dateCol">{{ $item->hora }}</td>
          <td>{{ $item->contacto_formated }}</td>
          <td>{{ $item->actividad->nombre }}</td>
          <td>{{ $item->asignado->usuario }}</td>
          <td class="crudCol">
            <x-crud :routeEdit="route('crm.edit', [$item->id])" />
          </td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
      </tfoot>
    </table>
  </div>

  <x-aditional-info text='Semana' />
  <div class="table-responsive">
    <table id="table" class="table table-striped table-sm">
      <thead>
      </thead>
      <tbody>
        @foreach ($semana as $item)
        <tr>
          <td class="dateCol">{{ $item->fecha }}</td>
          <td class="dateCol">{{ $item->hora }}</td>
          <td>{{ $item->contacto_formated }}</td>
          <td>{{ $item->actividad->nombre }}</td>
          <td>{{ $item->asignado->usuario }}</td>
          <td class="crudCol">
            <x-crud :routeEdit="route('crm.edit', [$item->id])" />
          </td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
      </tfoot>
    </table>
  </div>

  <x-aditional-info text='Proximas' />
  <div class="table-responsive">
    <table id="table" class="table table-striped table-sm">
      <thead>
      </thead>
      <tbody>
        @foreach ($proximas as $item)
        <tr>
          <td class="dateCol">{{ $item->fecha }}</td>
          <td class="dateCol">{{ $item->hora }}</td>
          <td>{{ $item->contacto_formated }}</td>
          <td>{{ $item->actividad->nombre }}</td>
          <td>{{ $item->asignado->usuario }}</td>
          <td class="crudCol">
            <x-crud :routeEdit="route('crm.edit', [$item->id])" />
          </td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
      </tfoot>
    </table>
  </div>
</x-blue-board>

@section('modals')
<!-- Modal Tarea -->
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
        <form action="" method="post">
          @csrf
          <section id="datos-contacto">
            <h6><i class="fas fa-plus" data-toggle="modal" data-target="#modalContacto"></i>&nbsp; Datos del contacto</h6>
            <hr>
            <div class="form-row">
              <div class="form-group col-12 col-md-6">
                <label for="contacto_id">Contacto</label>
                <select class="form-control form-control-sm select2Class @error('contacto_id') is-invalid @enderror" name="contacto_id" id="contacto_id" data-tags="true">
                  <option disabled selected>Selecciona uno...</option>
                </select>
              </div>
              <div class="form-group col-12 col-md-6">
                <label for="organizacion">Organización</label>
                <input type="text" id="organizacion" class="form-control form-control-sm" value="{{ old('organizacion') }}" readonly>
              </div>
              <div class="form-group col-12 col-md-4">
                <label for="telefono">Telefono</label>
                <input type="text" id="telefono" class="form-control form-control-sm" value="{{ old('telefono') }}" readonly>
              </div>
              <div class="form-group col-12 col-md-4">
                <label for="email">Email</label>
                <input type="text" id="email" class="form-control form-control-sm" value="{{ old('email') }}" readonly>
              </div>
              <div class="form-group col-12 col-md-4">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" class="form-control form-control-sm" value="{{ old('direccion') }}" readonly>
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
                  {{-- @foreach ($ as $item)
                  <option value="{{ $item->id }}" {{ old('actividad_id') == $item->id ? 'selected' : '' }}>{{ $item-> }}</option>
                  @endforeach --}}
                </select>
              </div>
              <div class="form-group col-12 col-md-6">
                <label for="asignado_id">Asignar a</label>
                <select class="form-control form-control-sm  @error('asignado_id') is-invalid @enderror" name="asignado_id" id="asignado_id">
                  <option disabled selected>Selecciona uno</option>
                  {{-- @foreach ($ as $item)
                  <option value="{{ $item->id }}" {{ old('asignado_id') == $item->id ? 'selected' : '' }}>{{ $item-> }}</option>
                  @endforeach --}}
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
        <button type="button" class="btn btn-secondary">Agendar</button>
        <button type="button" class="btn btn-primary">Crear</button>
      </div>
    </div>
  </div>
</div>

<x-add-contacto />
@endsection

@endsection

@section('scripts')
@endsection
