@extends('layouts.factura')

@section('content')
  <button onClick="imprimir()" style="width: 5%; position: fixed; top 0; left: 0;" id="printer"><em
      class="fa fa-print"></em></button>

  @include('Administracion._A5')

  @include('Administracion._A5')

@endsection
