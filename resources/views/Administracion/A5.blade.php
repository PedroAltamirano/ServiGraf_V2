@extends('layouts.factura')

@section('content')
  <div class="absolute container_a5" style="top: 0mm; left: 0mm;">
    @include('Administracion._A5')
  </div>
  <div class="absolute container_a5" style="top: 149mm; left: 0mm;">
    @include('Administracion._A5')
  </div>
@endsection
