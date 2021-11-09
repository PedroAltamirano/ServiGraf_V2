@extends('layouts.home', ['txtcolor' => 'text-noimg', 'tooglercolor' => 'black'])

@section('home-content')
<div class="container-fluid text-center my-auto" style="max-width: 900px;font-family: ABeeZee, sans-serif;padding: 20px;height: 100%;">
  <div class="row justify-content-center align-items-center h-100" style="width: 100%;height: 100%;margin: 0px;padding: 0px;margin-top: auto;margin-bottom: auto;">
    <div class="col-12" style="margin: 0;padding: 0;"><img class="img-fluid" src="{{ asset('img/servigraf-logo.png') }}" alt="logo" width="100%" height="100%">
      <h3 class="text-black-50" style="margin: 0px;padding: 0px;font-family: ABeeZee, sans-serif;">Diseño gráfico &amp; impresión offset<br></h3>
    </div>
  </div>
</div>
@endsection
