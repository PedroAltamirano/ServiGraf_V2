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

<x-blueBoard
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
        <input type="text" name="nombre" id="nombre" class="form-control form-control-sm @error('nombre') is-invalid @enderror" value="{{ old('nombre', $empresa->nombre) }}">
      </div>
      <div class="form-group col-6 col-md-2">
        <label for="representante">Representante</label>
        <input type="text" name="representante" id="representante" class="form-control form-control-sm @error('representante') is-invalid @enderror" value="{{ old('representante', $empresa->representante) }}">
      </div>
      <div class="form-group col-12 col-md-2">
        <label for="ruc">RUC</label>
        <input type="text" minlength="13" maxlength="13" pattern="[0-9]{13}" name="ruc" id="ruc" class="form-control form-control-sm @error('ruc') is-invalid @enderror" value="{{ old('ruc', $empresa->ruc) }}">
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

      <x-aditionalInfo />

      <div class="form-group col-4 col-md-2">
        <label for="inicio">Inicio de pedidos</label>
        <input type="number" min="0" max="9999999" name="inicio" id="inicio" class="form-control form-control-sm @error('inicio') is-invalid @enderror" value="{{ old('inicio', $empresa->inicio) }}">
      </div>
      <div class="form-group col-4 col-md-2">
        <label for="iva">% IVA</label>
        <input type="number" min="1" max="99" name="iva" id="iva" class="form-control form-control-sm @error('iva') is-invalid @enderror" value="{{ old('iva', $empresa->iva) }}">
      </div>
      <div class="form-group col-12 col-md-4">
        <label for="cloud">Cloud</label>
        <input type="url" name="cloud" id="cloud" class="form-control form-control-sm @error('cloud') is-invalid @enderror" value="{{ old('cloud', $empresa->cloud) }}">
      </div>
    </div>
  </form>
</x-blueBoard>
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

  $('#formSubmit').click(function(){
    $('#form').submit();
  });
</script>
@endsection
