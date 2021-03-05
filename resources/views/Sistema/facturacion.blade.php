@extends('layouts.app')

@section('links')
@endsection

@section('desktop-content')

<x-path
  :items="[
    [
      'text' => 'Facturación de Empresas',
      'current' => true,
      'href' => '#',
    ]
  ]"
/>

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
        <td class="text-center"><img src="{{ $logo }}" alt="{{ $item->id }}" style="max-width: 100px;"></td>
        <td class="text-center">{{ $item->impresion ? 'A4' : 'A5' }}</td>
        <td class="text-center"><a class='fa fa-edit modFactura @if ($item->status) text-success @else text-danger @endif' href="#modalFactura" data-toggle="modal"
          data-route='{{route('facturacion-empresas.update', $item->id)}}'
          data-empresa="{{ $item->empresa }}"
          data-representante="{{ $item->representante }}"
          data-ruc="{{ $item->ruc }}"
          data-caja="{{ $item->caja }}"
          data-inicio="{{ $item->inicio }}"
          data-valido_de="{{ $item->valido_de }}"
          data-valido_a="{{ $item->valido_a }}"
          data-logo="{{ $logo }}"
          data-status="{{ $item->status }}"
          data-impresion="{{ $item->impresion }}"></a>
          {{-- <a class='fa fa-eye' id="{{ $item->id }}"></a></td> --}}
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
      <form action="{{ route('facturacion-empresas.store') }}" method="post" class="modal-path" enctype="multipart/form-data">
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
    modal.find('.modal-path').attr('action', '{{ route("facturacion-empresas.store") }}');
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
