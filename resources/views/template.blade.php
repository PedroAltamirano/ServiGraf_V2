@extends('layouts.app')

@section('desktop-content')
{{-- <x-errors />
<x-fab /> --}}

<x-path
  :items="[
    [
      'text' => 'Libro Diario',
      'current' => false,
      'href' => route('libro'),
    ],
    [
      'text' => 'Entrada',
      'current' => true,
      'href' => '#',
    ]
  ]"
/>

<x-blueBoard
  title='Áreas'
  :foot="[
    ['text'=>'Modal', 'href'=>'#modalName', 'id'=>'newModal', 'tipo'=> 'modal'],
    ['text'=>'Nuevo', 'href'=>route(''), 'id'=>'nuevo', 'tipo'=> 'link'],
    ['text'=>$action, 'href'=>'#', 'id'=>'formSubmit', 'tipo'=> 'link'],
    ['text'=>'fas fa-print', 'href'=>'#', 'id'=>'mes', 'tipo'=> 'button', 'print-target' => 'table'],
  ]"
  class="d-print-none"
></x-blueBoard>

<table id="table" class="table table-striped table-sm">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col" class="crudCol">Crud</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($ as $item)
    <tr>
      <td>{{ $item-> }}</td>
      <td>
        <x-crud :routeSee='route(.edit, [$->id])', :modalSee='$model', :routeEdit='route(.edit, [$->id])', :modalEdit='$model', :routeDelete='route(.edit, [$->id])' />
      </td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
  </tfoot>
</table>

<x-report :title="$cli->contacto->nombre.' '.$cli->contacto->apellido" :items="$items"></x-report>

<x-addCliente/>

<x-filters :clientes="$clientes" cli=1 cob=1>

<x-recibo />

<x-procesos label='Proceso padre' name='parent_id' :old="old('parent_id', $proceso->parent_id)" />

<x-addProveedor />

<x-procesos-area id='procesos' name='proceso_id[]' :old='$pedido->proceso_id' />

<x-aditionalInfo text='' />

@endsection

@section('scripts')
@endsection
