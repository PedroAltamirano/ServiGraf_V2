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

<x-blueBoard
  :title=$text
  :foot="[
    ['text'=>$action, 'href'=>'#', 'id'=>'formSubmit', 'tipo'=> 'link']
  ]"
>
  <form action="{{ $path }}" method="POST" id="form">
    @csrf
    @include('Produccion.formPedido')
  </form>
</x-blueBoard>
@endsection

@section('modals')
  @yield('modals1')
  @yield('modals2')
@endsection

@section('scripts')
@endsection
