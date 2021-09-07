@extends('layouts.app')

@section('links')
@endsection

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Pedidos',
      'current' => false,
      'href' => route('pedidos'),
    ],
    [
      'text' => $text,
      'current' => true,
      'href' => $path,
    ]
  ]"
/>

@php
  $route_duplicate = $pedido->id ? route('pedido.duplicate', [$pedido->id]) : '#';
@endphp
<x-blue-board
:title=$text
:foot="[
  ['text' => $action, 'href' => '#', 'id' => 'formSubmit', 'tipo' => 'link'],
  ['text' => 'Duplicar', 'href' => $route_duplicate, 'id' => 'duplicarPedido', 'tipo' => 'link', 'condition' => App\Security::hasModule('31')],
  ['text' => 'fas fa-print', 'href' => '#', 'id' => 'print', 'tipo' => 'button', 'print-target' => 'form']
  ]"
>
  <form action="{{ $path }}" method="POST" id="form">
    @csrf
    @method($method)
    @include('Produccion.formPedido')
  </form>
</x-blue-board>
@endsection

@section('modals')
  @yield('modals1')
  @yield('modals2')
@endsection

@section('scripts')
<script>
  $('#formSubmit').click(function(){
    $('#form').submit();
  });
</script>
@endsection
