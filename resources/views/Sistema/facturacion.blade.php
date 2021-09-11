@extends('layouts.app')

@section('desktop-content')

<x-path
  :items="[
    [
      'text' => 'Empresas de Facturación',
      'current' => true,
      'href' => '#',
    ]
  ]"
/>

<x-blue-board
  title='Facturas'
  :foot="[
    ['text'=>'Nueva', 'href'=>'#modalFactura', 'id'=>'newFactura', 'tipo'=>'modal'],
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
        <th scope="col" class="w-5">Impresión</th>
        <th scope="col" class="w-5">Crud</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($facturas as $item)
      @php
        $logo = $item->logo ? asset("empresa_logo/$item->logo") : asset('logos/logo.svg');
        $class = $item->status ? 'text-success' : 'text-danger';
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
        <td class="text-center">
          <x-crud routeEdit="#modalFactura" :modalEdit="$item" :classEdit="$class" />
      </tr>
      @endforeach
    </tbody>
    <tfoot>
    </tfoot>
  </table>
</x-blue-board>

<x-blue-board
  title='Ivas'
  :foot="[
    ['text'=>'Nuevo', 'href'=>'#modalIva', 'id'=>'newIva', 'tipo'=>'modal'],
  ]"
>
  <div class="row">
    @foreach ($ivas as $item)
    <div class="col-6 col-md-2">
      <x-crud routeEdit="#modalIva" :modalEdit="$item" :classEdit="$item->status ? 'text-success' : 'text-danger'" />
      &nbsp;&nbsp;{{ $item->porcentaje }}
    </div>
    @endforeach
  </div>
</x-blue-board>

<x-blue-board
  title='Retenciones Iva'
  :foot="[
    ['text'=>'Nueva', 'href'=>'#modalRetencion', 'id'=>'newRetencionIva', 'tipo'=>'modal'],
  ]"
>
  <div class="row">
    @foreach ($ret_iva as $item)
    <div class="col-6 col-md-2">
      <x-crud routeEdit="#modalRetencion" :modalEdit="$item" :classEdit="$item->status ? 'text-success' : 'text-danger'" />

      &nbsp;&nbsp;{{ $item->porcentaje }}
    </div>
    @endforeach
  </div>
</x-blue-board>

<x-blue-board
  title='Retenciones Fuente'
  :foot="[
    ['text'=>'Nueva', 'href'=>'#modalRetencion', 'id'=>'newRetencionFnt', 'tipo'=>'modal'],
  ]"
>
  <div class="row">
    @foreach ($ret_fnt as $item)
    <div class="col-6 col-md-2">
      <x-crud routeEdit="#modalRetencion" :modalEdit="$item" :classEdit="$item->status ? 'text-success' : 'text-danger'" />
      &nbsp;&nbsp;{{ $item->porcentaje }}
    </div>
    @endforeach
  </div>
</x-blue-board>
@endsection

@section('modals')
@include('Sistema.modal-fact-emp')
@include('Sistema.modal-iva-ret')
@endsection

@section('scripts')
<script>
  let today = moment().format('Y-MM-DD');

  $('#table').DataTable({
    "paging":   true,
    "ordering": true,
    "info":     false,
    "responsive": true,
  });

  // Empresa de facturacion
  const routeStore = `{{ route("facturacion-empresas.store") }}`;
  const routeUpdate = `{{route('facturacion-empresas.update', 0)}}`;
  $('#modalFactura').on('show.bs.modal', event => {
    let data = $(event.relatedTarget).data('modaldata');
    // let logo = $(event.relatedTarget).data('logo') || null;
    let modal = $(event.target);

    let path = data ? routeUpdate.replace('/0', `/${data.id}`) : routeStore;
    modal.find('.modal-title').html(data ? 'Modificar Empresa de Facturación' : 'Nueva Empresa de Facturación');
    modal.find('.modal-path').attr('action', path);
    modal.find("input[name='_method']").val(data ? 'PUT' : 'POST');
    modal.find(".submitbtn").html(data ? 'Modificar' : 'Crear');

    modal.find('#empresa').val(data ? data.empresa : '');
    modal.find('#representante').val(data ? data.representante : '');
    modal.find('#direccion').val(data ? data.direccion : '');
    modal.find('#correo').val(data ? data.correo : '');
    modal.find('#telefono').val(data ? data.telefono : '');
    modal.find('#celular').val(data ? data.celular : '');
    modal.find('#ruc').val(data ? data.ruc : '');
    modal.find('#valido_de').val(data ? data.valido_de : '');
    modal.find('#valido_a').val(data ? data.valido_a : '');
    modal.find('#clave_sri').val(data ? data.clave_sri : '');
    modal.find('#clave_firma_sri').val(data ? data.clave_firma_sri : '');
    modal.find('#caja').val(data ? data.caja : '');
    modal.find('#inicio').val(data ? data.inicio : '');
    modal.find('#iva_id').val(data ? data.iva_id : '');
    modal.find('#ret_iva_id').val(data ? data.ret_iva_id : '');
    modal.find('#ret_fuente_id').val(data ? data.ret_fuente_id : '');
    modal.find('#impresion').val(data ? data.impresion : '');
    modal.find('#status').prop('checked', data ? Boolean(Number(data.status)) : false);
    // modal.find('#logo').attr('data-default-file', logo).dropify();
  });


  // Iva
  const routeStoreIva = `{{ route('iva.store') }}`;
  const routeUpdateIva = `{{route('iva.update', 0)}}`;
  $('#modalIva').on('show.bs.modal', event => {
    let data = $(event.relatedTarget).data('modaldata');
    let modal = $(event.target);

    let path = data ? routeUpdateIva.replace('/0', `/${data.id}`) : routeStoreIva;
    modal.find('.modal-title').html(data ? 'Modificar Iva' : 'Nuevo Iva');
    modal.find('.modal-path').attr('action', path);
    modal.find("input[name='_method']").val(data ? 'PUT' : 'POST');
    modal.find(".submitbtn").html(data ? 'Modificar' : 'Crear');

    modal.find('#porcentaje-iva').val(data ? data.porcentaje : '');
    modal.find('#status-iva').prop('checked', data ? Boolean(Number(data.status)) : false);
  });


  // Retencion
  const routeStoreRetencion = `{{ route('retencion.store') }}`;
  const routeUpdateRetencion = `{{route('retencion.update', 0)}}`;
  $('#modalRetencion').on('show.bs.modal', event => {
    let data = $(event.relatedTarget).data('modaldata');
    let modal = $(event.target);
    let a = Boolean(Number(data.status))
    debugger;

    let path = data ? routeUpdateRetencion.replace('/0', `/${data.id}`) : routeStoreRetencion;
    modal.find('.modal-title').html(data ? 'Modificar Retención' : 'Nueva Retención');
    modal.find('.modal-path').attr('action', path);
    modal.find("input[name='_method']").val(data ? 'PUT' : 'POST');
    modal.find(".submitbtn").html(data ? 'Modificar' : 'Crear');

    modal.find('#porcentaje-ret').val(data ? data.porcentaje : '');
    modal.find('#tipo').val(data ? data.tipo : '');
    modal.find('#descripcion').val(data ? data.descripcion : '');
    modal.find('#status-ret').prop('checked', data ? Boolean(Number(data.status)) : false);
  });
</script>
@endsection
