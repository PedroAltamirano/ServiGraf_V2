@extends('layouts.app')

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Contactos',
      'current' => false,
      'href' => route('contacto'),
    ],
    [
      'text' => $text,
      'current' => true,
      'href' => '#',
    ]
  ]"
/>

<x-blue-board
  :title=$text
  :foot="[
    ['text' => $action, 'href' => '#', 'id' => 'formSubmit', 'tipo' => 'link'],
  ]"
>
  <form action="{{ $path }}" method="POST" id="form">
    @csrf
    @method($method)
    @include('Ventas._contacto')
  </form>
</x-blue-board>

<x-aditional-info text='' />

@endsection

@section('scripts')
@endsection
