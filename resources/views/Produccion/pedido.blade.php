@extends('layouts.app')

@section('desktop-content')
  <x-path
    :items="[ ['text' => 'Pedidos', 'current' => false, 'href' => route('pedidos')], ['text' => $text, 'current' => true, 'href' => $path] ]" />

  @php
  $route_duplicate = $pedido->id ? route('pedido.duplicate', [$pedido->id]) : '#';
  $foot = [['text' => $action, 'href' => '#', 'id' => 'formSubmit', 'tipo' => 'link'], ['text' => 'Nuevo', 'href' => route('pedido.create'), 'id' => 'new', 'tipo' => 'link', 'condition' => $pedido->id ?? 0], ['text' => 'Duplicar', 'href' => $route_duplicate, 'id' => 'duplicarPedido', 'tipo' => 'link', 'condition' => App\Security::hasModule('31')], ['text' => 'fas fa-print', 'href' => '#', 'id' => 'print', 'tipo' => 'button', 'print-target' => 'form']];
  @endphp
  <x-blue-board :title=$text :foot=$foot>
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
