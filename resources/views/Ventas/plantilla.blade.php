@extends('layouts.app')

@section('links')
<link rel="stylesheet" href="{{ asset('css/trumbowyg.css') }}">
@endsection

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Plantillas',
      'current' => false,
      'href' => route('plantilla'),
    ],
    [
      'text' => $text,
      'current' => true,
      'href' => '#',
    ]
  ]"
/>

<x-blue-board
  title='Plantilla'
  :foot="[
    ['text' => $action, 'href' => '#', 'id' => 'formSubmit', 'tipo' => 'link'],
  ]"
>
  <form action="{{ $path }}" method="POST" id="form">
    @csrf
    @method($method)
    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input type="text"
        class="form-control form-control-sm" name="nombre" id="nombre" value="{{ old('nombre', $plantilla->nombre) }}" />
    </div>
    <div class="form-group">
      <label for="contenido">Contenido</label>
      <textarea class="form-control form-control-sm editor" name="contenido" id="contenido" rows="3">{{ old('contenido', $plantilla->contenido) }}</textarea>
    </div>
  </form>
</x-blue-board>
@endsection

@section('scripts')
<script src="{{ asset('js/trumbowyg.js') }}" type="text/javascript"></script>
@endsection
