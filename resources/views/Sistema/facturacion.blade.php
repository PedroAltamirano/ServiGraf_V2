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
        $logo = Storage::disk('facturas')->exists($item->logo) ? asset($url) : asset('logos/logo.svg');
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
          data-empresa='@json($item)'
          data-logo="{{ $logo }}"></a>
          {{-- <a class='fa fa-eye' id="{{ $item->id }}"></a></td> --}}
      </tr>
      @endforeach
    </tbody>
    <tfoot>
    </tfoot>
  </table>
</x-blueBoard>

<x-blueBoard
  title='Ivas'
  :foot="[
    ['text'=>'Nuevo', 'href'=>'#modalIva', 'id'=>'newIva', 'tipo'=> 'modal'],
  ]"
>
  <div class="row">
    @foreach ($ivas as $item)
    <div class="col-6 col-md-2">
    <a class="fas fa-edit modIva" href="#modalIva" data-toggle="modal" data-iva='@json($item)'></a>
      &nbsp;&nbsp;{{ $item->porcentaje }}
    </div>
    @endforeach
  </div>
</x-blueBoard>

<x-blueBoard
  title='Retenciones Iva'
  :foot="[
    ['text'=>'Nueva', 'href'=>'#modalRetencion', 'id'=>'newRetencionIva', 'tipo'=> 'modal'],
  ]"
>
  <div class="row">
    @foreach ($ret_iva as $item)
    <div class="col-6 col-md-2">
    <a class="fas fa-edit modRetencion" href="#modalRetencion" data-toggle="modal" data-retencion='@json($item)'></a>
      &nbsp;&nbsp;{{ $item->porcentaje }}
    </div>
    @endforeach
  </div>
</x-blueBoard>

<x-blueBoard
  title='Retenciones Fuente'
  :foot="[
    ['text'=>'Nueva', 'href'=>'#modalRetencion', 'id'=>'newRetencionFnt', 'tipo'=> 'modal'],
  ]"
>
  <div class="row">
    @foreach ($ret_fnt as $item)
    <div class="col-6 col-md-2">
    <a class="fas fa-edit modRetencion" href="#modalRetencion" data-toggle="modal" data-retencion='@json($item)'></a>
      &nbsp;&nbsp;{{ $item->porcentaje }}
    </div>
    @endforeach
  </div>
</x-blueBoard>

@include('Sistema.modal-fact-emp')
@include('Sistema.modal-iva-ret')

@endsection

@section('scripts')
<script>
  let today = "{{ date('Y-m-d') }}";

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
  const route = "{{route('facturacion-empresas.update', 0)}}";
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
    if(modal.find('.modal-activo').prop('checked') != true){
      modal.find('.modal-activo').click();
    }
    modal.find('.modal-logo').attr('data-default-file', '');
    modal.find('.modal-path').attr('action', '{{ route("facturacion-empresas.store") }}');
    modal.find('input[name="_method"]').val('POST');
  });

  $('.modFactura').on('click', function (event) {
    let data = $(this).data('empresa');
    let modal = $('#modalFactura');
    modal.find('.modal-title').html('Modificar Factura');
    modal.find('.modal-empresa').val(data.empresa);
    modal.find('.modal-representante').val(data.representante);
    modal.find('.modal-ruc').val(data.ruc);
    modal.find('.modal-caja').val(data.caja);
    modal.find('.modal-inicio').val(data.inicio);
    modal.find('.modal-valido_de').val(data.valido_de);
    modal.find('.modal-valido_a').val(data.valido_a);
    modal.find('.modal-iva_id').val(data.iva_id);
    modal.find('.modal-ret_iva_id').val(data.ret_iva_id);
    modal.find('.modal-ret_fuente_id').val(data.ret_fuente_id);
    modal.find('.modal-impresion').val(data.impresion);
    if(modal.find('.modal-activo').prop('checked') != Boolean(data.status)){
      modal.find('.modal-activo').click();
    }
    modal.find('.modal-logo').data('default-file', $(this).data('logo'));
    modal.find('.modal-path').attr('action', route.replace("/0", "/"+data.id));
    modal.find('input[name="_method"]').val('PUT');
  });

  //Iva
  const routeUpdateIva = "{{route('iva.update', 0)}}";
  $('#newIva').on('click', function (event) {
    var modal = $('#modalIva');
    modal.find('.modal-iva-title').html('Nuevo Iva');
    modal.find('.modal-iva-porcentaje').val('0.00');
    modal.find('.modal-iva-path').attr('action', '{{ route("iva.store") }}');
    modal.find('input[name="_method"]').val('POST');
  });

  $('.modIva').on('click', function (event) {
    let modal = $('#modalIva');
    let data = $(this).data('iva');
    modal.find('.modal-iva-title').html('Modificar Iva');
    modal.find('.modal-iva-porcentaje').val(data.porcentaje);
    modal.find('.modal-iva-path').attr('action', routeUpdateIva.replace("/0", "/"+data.id));
    modal.find('input[name="_method"]').val('PUT');
  });

  //Retencion
  const routeUpdateRetencion = "{{route('retencion.update', 0)}}";
  $('#newRetencionIva,#newRetencionFnt').on('click', function (event) {
    var modal = $('#modalRetencion');
    modal.find('.modal-ret-title').html('Nueva Retencion');
    modal.find('.modal-ret-porcentaje').val('0.00');
    modal.find('.modal-ret-tipo').val('1');
    modal.find('.modal-ret-descripcion').html('');
    modal.find('.modal-ret-path').attr('action', '{{ route("retencion.store") }}');
    modal.find('input[name="_method"]').val('POST');
  });

  $('.modRetencion').on('click', function (event) {
    let modal = $('#modalRetencion');
    let data = $(this).data('retencion');
    console.log(data)
    modal.find('.modal-ret-title').html('Modificar Retencion');
    modal.find('.modal-ret-porcentaje').val(data.porcentaje);
    modal.find('.modal-ret-tipo').val(data.tipo);
    modal.find('.modal-ret-descripcion').html(data.descripcion);
    modal.find('.modal-ret-path').attr('action', routeUpdateRetencion.replace("/0", "/"+data.id));
    modal.find('input[name="_method"]').val('PUT');
  });
</script>
@endsection
