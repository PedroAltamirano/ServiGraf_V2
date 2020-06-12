@extends('layouts.app')

@section('links')
@endsection

@section('desktop-content')
<path-route
  :items="[
    {
      text: 'Pedidos',
      current: false,
      href: '/pedidos',
    },
    {
      text: '{{ $text }}',
      current: true,
      href: '{{ $path }}',
    }
  ]"
></path-route>

<blue-board
  title='{{ $text }}'
  :foot="[
    {text:'{{ $action }}', href:'#', id:'formSubmit', tipo: 'link'}
  ]"
>
  <form action="{{ $path }}" method="POST" id="form">
    @csrf
    @include('Produccion.formPedido')
  </form>
</blue-board>
@endsection

@section('modals')
  @yield('modals1')
  @yield('modals2')
@endsection

@section('scripts')
@endsection
