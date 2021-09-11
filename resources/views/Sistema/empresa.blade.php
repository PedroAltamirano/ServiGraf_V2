@extends('layouts.app')

@section('desktop-content')

<x-path
  :items="[
    [
      'text' => 'Empresa',
      'current' => true,
      'href' => '#',
    ]
  ]"
/>

<x-blue-board
  title='Datos de la empresa'
  :foot="[
    ['text'=>'Guardar', 'href'=>'#', 'id'=>'formSubmit', 'tipo'=>'link'],
  ]"
>
  @if ($empresa->id)
  <form action="{{ route('empresa.update', $empresa->id) }}" method="POST" id="form">
    @method('PUT')
  @else
  <form action="{{ route('empresa.store') }}" method="POST" id="form">
    @method('POST')
  @endif
    @csrf
    <div class="form-row">
      <div class="form-group col-6 col-md-2">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control form-control-sm @error('nombre') is-invalid @enderror" value="{{ old('nombre', $empresa->nombre) ?? Auth::user()->empresa->nombre }}">
      </div>
      <div class="form-group col-6 col-md-2">
        <label for="representante">Representante</label>
        <input type="text" name="representante" id="representante" class="form-control form-control-sm @error('representante') is-invalid @enderror" value="{{ old('representante', $empresa->representante) }}">
      </div>
      <div class="form-group col-12 col-md-2">
        <label for="ruc">RUC</label>
        <input type="text" minlength="13" maxlength="13" pattern="[0-9]{13}" name="ruc" id="ruc" class="form-control form-control-sm @error('ruc') is-invalid @enderror" value="{{ old('ruc', $empresa->ruc) ?? Auth::user()->empresa->id }}">
      </div>
      <div class="form-group col-6 col-md-2">
        <label for="telefono">Teléfono</label>
        <input type="text" minlength="7" maxlength="7" pattern="[0-9]{7}" name="telefono" id="telefono" class="form-control form-control-sm @error('telefono') is-invalid @enderror" value="{{ old('telefono', $empresa->telefono) }}">
      </div>
      <div class="form-group col-6 col-md-2">
        <label for="celular">Celular</label>
        <input type="text" minlength="10" maxlength="10" pattern="[0-9]{10}"  name="celular" id="celular" class="form-control form-control-sm @error('celular') is-invalid @enderror" value="{{ old('celular', $empresa->celular) }}">
      </div>
      <div class="form-group col-12 col-md-2">
        <label for="correo">Correo</label>
        <input type="text" name="correo" id="correo" class="form-control form-control-sm @error('correo') is-invalid @enderror" value="{{ old('correo', $empresa->correo) }}">
      </div>
      <div class="form-group col-12 col-md-2">
        <label for="ciudad">Ciudad</label>
        <input type="text" name="ciudad" id="ciudad" class="form-control form-control-sm @error('ciudad') is-invalid @enderror" value="{{ old('ciudad', $empresa->ciudad) }}">
      </div>
      <div class="form-group col-12 col-md-4">
        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" id="direccion" class="form-control form-control-sm @error('direccion') is-invalid @enderror" value="{{ old('direccion', $empresa->direccion) }}">
      </div>
      <div class="form-group col-12 col-md-4">
        <label for="web">Web</label>
        <input type="url" name="web" id="web" class="form-control form-control-sm @error('web') is-invalid @enderror" value="{{ old('web', $empresa->web) }}">
      </div>

      <x-aditional-info />

      <div class="form-group col-4 col-md-2">
        <label for="inicio">Inicio de pedidos</label>
        <input type="number" min="0" max="9999999" name="inicio" id="inicio" class="form-control form-control-sm @error('inicio') is-invalid @enderror" value="{{ old('inicio', $empresa->inicio) }}">
      </div>
      {{-- <div class="form-group col-4 col-md-2">
        <label for="iva">% IVA</label>
        <input type="number" min="1" max="99" name="iva" id="iva" class="form-control form-control-sm @error('iva') is-invalid @enderror" value="{{ old('iva', $empresa->iva) }}">
      </div> --}}
      <div class="form-group col-12 col-md-4">
        <label for="cloud">Cloud</label>
        <input type="url" name="cloud" id="cloud" class="form-control form-control-sm @error('cloud') is-invalid @enderror" value="{{ old('cloud', $empresa->cloud) }}">
      </div>
      <div class="form-group col-12 col-md-4">
        <label for="mail">Cliente de email</label>
        <input type="url" name="mail" id="mail" class="form-control form-control-sm @error('mail') is-invalid @enderror" value="{{ old('mail', $empresa->mail) }}">
      </div>
    </div>
  </form>
</x-blue-board>

<x-blue-board
  title='Centro de Costos'
  :foot="[
    ['text'=>'Nuevo', 'href'=>'#modalCCostos', 'id'=>'newCCostos', 'tipo'=>'modal'],
  ]"
>
  <div class="row">
    @foreach ($ccostos as $item)
    <div class="col-6 col-md-2">
      <a class="fas fa-edit" href="#modalCCostos" data-toggle="modal" data-modaldata='@json($item)'></a>
      &nbsp;&nbsp;{{ $item->nombre }}
    </div>
    @endforeach
  </div>
</x-blue-board>
@endsection

@section('modals')
<!-- Modal Centro de Costos -->
<div class="modal fade" id="modalCCostos" tabindex="-1" role="dialog" aria-hidden="true">
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
            <label for="porcentaje">Nombre del Centro de Costos</label>
            <input type="text" name="nombre" id="nombre_ccosto" class="form-control">
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
@endsection

@section('scripts')
<script>
  $('#table').DataTable({
    "paging":   true,
    "ordering": true,
    "info":     false,
    "responsive": true,
  });

  //Centro de Costos
  const routeStore = `{{ route("centro-costos.store") }}`;
  const routeUpdate = `{{route('centro-costos.update', 0)}}`;
  $('#modalCCostos').on('show.bs.modal', event => {
    let data = $(event.relatedTarget).data('modaldata');
    let modal = $(event.target);

    let path = data ? routeUpdate.replace('/0', `/${data.id}`) : routeStore;
    modal.find('.modal-title').html(data ? 'Modificar Centro de Costos' : 'Nueva Centro de Costos');
    modal.find('.modal-path').attr('action', path);
    modal.find("input[name='_method']").val(data ? 'PUT' : 'POST');
    modal.find(".submitbtn").html(data ? 'Modificar' : 'Crear');

    modal.find('#nombre_ccosto').val(data ? data.nombre : '');
  });
</script>
@endsection
