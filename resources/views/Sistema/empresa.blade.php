@extends('layouts.app')

@section('links')
@endsection

@section('desktop-content')
<style>
  .text-hr {
  display: flex;
  align-items: center;
  font-family: sans-serif;
  width: 100%;
  margin: 15px auto;
  color: #444;
}
.text-hr__text {
  padding-right: 15px;
}
.text-hr__text:not(:first-child) {
  display: none;
}
.text-hr::after {
  flex: 1;
  background: #c7c7c7;
  content: "";
  height: 1px;
}
.text-hr--right .text-hr__text {
  order: 1;
  padding: 0 0 0 15px;
}
.text-hr--double .text-hr__text:nth-child(2) {
  order: 1;
  display: inline;
  padding: 0 0 0 15px;
}
.text-hr--center::before {
  flex: 1;
  background: #c7c7c7;
  content: "";
  height: 1px;
}
.text-hr--center .text-hr__text {
  padding: 0 15px;
}
.text-hr--triple .text-hr__text:nth-child(2) {
  order: 2;
  display: inline;
  padding: 0 15px;
}
.text-hr--triple .text-hr__text:nth-child(3) {
  order: 4;
  display: inline;
  padding: 0 0 0 15px;
}
.text-hr--triple::after {
  order: 3;
}
.text-hr--triple::before {
  flex: 1;
  background: #c7c7c7;
  content: "";
  height: 1px;
  order: 1;
}
.text-hr--loud .text-hr__text {
  font-size: 36px;
  font-weight: bold;
}
.text-hr--loud .text-hr__text:nth-child(2) {
  font-size: 12px;
  font-weight: normal;
}
</style>

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
      <div class="form-group col-12 col-md-4">
        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" id="direccion" class="form-control form-control-sm @error('direccion') is-invalid @enderror" value="{{ old('direccion', $empresa->direccion) }}">
      </div>
      <div class="form-group col-12 col-md-4">
        <label for="web">Web</label>
        <input type="url" name="web" id="web" class="form-control form-control-sm @error('web') is-invalid @enderror" value="{{ old('web', $empresa->web) }}">
      </div>

      <div class="text-hr">
        <span class="text-hr__text">Información adicional</span>
      </div>
      <div class="form-group col-4 col-md-2">
        <label for="inicio">Inicio</label>
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

<x-blueBoard
  title='Facturas'
  :foot="[
    ['text'=>'Nueva', 'href'=>'#modalFactura', 'id'=>'newFactura', 'tipo'=> 'modal'],
  ]"
>
  <table id="table" class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">Empresa</th>
        <th scope="col">Representante</th>
        <th scope="col">Ruc</th>
        <th scope="col">Caja</th>
        <th scope="col">Inicio</th>
        <th scope="col">Válido de</th>
        <th scope="col">Válido a</th>
        <th scope="col">Logo</th>
        <th scope="col" class="crudCol">Impresión</th>
        <th scope="col" class="crudCol">Crud</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($facturas as $item)
      @php
        $url = 'storage/facturas/'.$item->logo;
        $logo = Storage::disk('facturas')->exists($item->logo) ? asset($url) : asset('logos/ServiGraf_logoWeb.png');
      @endphp
      <tr>
        <td>{{ $item->empresa }}</td>
        <td>{{ $item->representante }}</td>
        <td>{{ $item->ruc }}</td>
        <td>{{ $item->caja }}</td>
        <td>{{ $item->inicio }}</td>
        <td>{{ $item->valido_de }}</td>
        <td>{{ $item->valido_a }}</td>
        <td><img src="{{ $logo }}" alt="{{ $item->id }}" style="max-width: 100px;"></td>
        <td>{{ $item->impresion ? 'A4' : 'A5' }}</td>
        <td><a class='fa fa-edit modFactura' href="#modalFactura" data-toggle="modal"
          data-route='{{route('factura.update', $item->id)}}' 
          data-empresa="{{ $item->empresa }}" 
          data-representante="{{ $item->representante }}" 
          data-ruc="{{ $item->ruc }}" 
          data-caja="{{ $item->caja }}" 
          data-inicio="{{ $item->inicio }}" 
          data-valido_de="{{ $item->valido_de }}" 
          data-valido_a="{{ $item->valido_a }}" 
          data-logo="{{ $logo }}"
          data-status="{{ $item->status }}"
          data-impresion="{{ $item->impresion }}"></a> <a class='fa fa-eye' id="{{ $item->id }}"></a></td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
    </tfoot>
  </table>
</x-blueBoard>

<!-- Modal CATEGORIA -->
<div id="modalFactura" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{ route('factura.store') }}" method="post" class="modal-path" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-6 col-md-6">
              <label for="empresa">Empresa</label>
              <input type="text" name="empresa" id="empresa" class="form-control modal-empresa @error('empresa') is-invalid @enderror" value="{{ old('empresa') }}">
            </div>
            <div class="form-group col-6 col-md-6">
              <label for="representante">Representante</label>
              <input type="text" name="representante" id="representanteModal" class="form-control modal-representante @error('representante') is-invalid @enderror" value="{{ old('representante') }}">
            </div>
            <div class="form-group col-12 col-md-6">
              <label for="ruc">RUC</label>
              <input type="text" name="ruc" id="rucModal" class="form-control modal-ruc @error('ruc') is-invalid @enderror" value="{{ old('ruc') }}">
            </div>
            <div class="form-group col-6 col-md-3">
              <label for="caja">Caja</label>
              <input type="text" name="caja" id="caja" class="form-control modal-caja @error('caja') is-invalid @enderror" value="{{ old('caja') }}">
            </div>
            <div class="form-group col-6 col-md-3">
              <label for="inicio">Inicio</label>
              <input type="text" name="inicio" id="inicioModal" class="form-control modal-inicio @error('inicio') is-invalid @enderror" value="{{ old('inicio') }}">
            </div>
            <div class="form-group col-6 col-md-6">
              <label for="valido_de">Válido de</label>
              <input type="date" value="{{ date('Y-m-d') }}" name="valido_de" id="valido_de" class="form-control modal-valido_de @error('valido_de') is-invalid @enderror" value="{{ old('valido_de') }}">
            </div>
            <div class="form-group col-6 col-md-6">
              <label for="valido_a">Válido a</label>
              <input type="date" value="{{ date('Y-m-d') }}" name="valido_a" id="valido_a" class="form-control modal-valido_a @error('valido_a') is-invalid @enderror" value="{{ old('valido_a') }}">
            </div>
            <div class="form-group col-6">
              <label for="impresion">Impresión</label>
              <select name="impresion" id="impresion" class="form-control modal-impresion @error('impresion') is-invalid @enderror">
                <option value="1" {{ old('impresion') == '1' ? 'selected' : '' }}>A4</option>
                <option value="0" {{ old('impresion') == '0' ? 'selected' : '' }}>A5</option>
              </select>
            </div>
            <div class="form-group col-2">
              <label for="statusDiv">Activo</label>
              <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
                <input type="checkbox" class="custom-control-input modal-activo @error('status') is-invalid @enderror" id="status" name="status" value="1" {{ old('status') == '1' ? 'checked':'' }}>
                <label class="custom-control-label" for="status"></label>
              </div>
            </div>
            <div class="form-group col-12">
              <label for="logo">Logo <span class="text-muted">Max. 2MB</span></label>
              <input type="file" class="dropify modal-logo" id="logo" name="logo" title="logo del usuario" accept="image/*" size="2MB" data-default-file=''>
            </div>
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
  let date = new Date();
  let today = date.getFullYear()+"-"+("0" + date.getMonth()).slice(-2)+"-"+("0" + date.getDate()).slice(-2);

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

  // CATEGORIAS
  $('#newFactura').on('click', function (event) {
    var modal = $('#modalFactura');
    modal.find('.modal-title').html('Nueva Factura');
    modal.find('.modal-empresa').val('');
    modal.find('.modal-representante').val('');
    modal.find('.modal-ruc').val('');
    modal.find('.modal-caja').val('');
    modal.find('.modal-inicio').val('');
    modal.find('.modal-valido_de').val(today);
    modal.find('.modal-valido_a').val(today);
    modal.find('.modal-impresion').val('1');
    modal.find('.modal-logo').attr('data-default-file', '');
    modal.find('.modal-path').attr('action', '{{ route("factura.store") }}');
    modal.find('input[name="_method"]').val('POST');
  });

  $('.modFactura').on('click', function (event) {
    var button = $(this);
    var modal = $('#modalFactura');
    modal.find('.modal-title').html('Modificar Factura');
    modal.find('.modal-empresa').val(button.data('empresa'));
    modal.find('.modal-representante').val(button.data('representante'));
    modal.find('.modal-ruc').val(button.data('ruc'));
    modal.find('.modal-caja').val(button.data('caja'));
    modal.find('.modal-inicio').val(button.data('inicio'));
    modal.find('.modal-valido_de').val(button.data('valido_de'));
    modal.find('.modal-valido_a').val(button.data('valido_a'));
    modal.find('.modal-impresion').val(button.data('impresion'));
    if(modal.find('.modal-activo').prop('checked') != Boolean(button.data('status'))){
      modal.find('.modal-activo').click();
    }
    console.log(button.data('logo'))
    // modal.find('.modal-logo').data('default-file', button.data('logo'));
    modal.find('.modal-path').attr('action', button.data('route'));
    modal.find('input[name="_method"]').val('PUT');
  });
</script>
@endsection