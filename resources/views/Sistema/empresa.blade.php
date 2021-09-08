@extends('layouts.app')

@section('links')
@endsection

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
    ['text'=>'Guardar', 'href'=>'#', 'id'=>'formSubmit', 'tipo'=> 'link'],
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
    </div>
  </form>
</x-blue-board>

<x-blue-board
  title='Centro de Costos'
  :foot="[
    ['text'=>'Nuevo', 'href'=>'#modalCCostos', 'id'=>'newCCostos', 'tipo'=> 'modal'],
  ]"
>
  <div class="row">
    @foreach ($ccostos as $item)
    <div class="col-6 col-md-2">
    <a class="fas fa-edit modCCostos" href="#modalCCostos" data-toggle="modal" data-ccosto='@json($item)'></a>
      &nbsp;&nbsp;{{ $item->nombre }}
    </div>
    @endforeach
  </div>
</x-blue-board>

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
            <input type="text" name="nombre" id="nombre_ccosto" class="form-control modal-nombre">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    $('#table').DataTable({
      "paging":   true,
      "ordering": true,
      "info":     false,
      "responsive": true,
    });
  });

  //Centro de Costos
  const routeUpdateCCostos = "{{route('centro-costos.update', 0)}}";
  $('#newCCostos').on('click', function (event) {
    var modal = $('#modalCCostos');
    modal.find('.modal-title').html('Nuevo Centro de Costos');
    modal.find('.modal-nombre').html('');
    modal.find('.modal-path').attr('action', '{{ route("centro-costos.store") }}');
    modal.find('input[name="_method"]').val('POST');
  });

  $('.modCCostos').on('click', function (event) {
    let modal = $('#modalCCostos');
    let data = $(this).data('ccosto');
    modal.find('.modal-title').html('Modificar Centro de Costos');
    modal.find('.modal-nombre').val(data.nombre);
    modal.find('.modal-path').attr('action', routeUpdateCCostos.replace("/0", "/"+data.id));
    modal.find('input[name="_method"]').val('PUT');
  });
</script>
@endsection
