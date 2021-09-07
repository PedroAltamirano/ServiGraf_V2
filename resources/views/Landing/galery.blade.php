@extends('layouts.home', ['txtcolor' => 'text-img', 'tooglercolor' => 'white'])

@section('home-content')
<div class="jumbotron jumbotron-fluid text-center" id="fondo" style="margin: 0px;font-family: ABeeZee, sans-serif;color: rgb(255,255,255);background-image: url(&quot;{{asset('img/imprenta_fondo1.jpeg')}}&quot;);padding: 0px;">
  <div class="text-center" id="img_overlay" style="background-color: rgba(0, 0, 0, 0.4);opacity: 1;width: 100%;height: 100%;">
    <h1 class="text-center jumbo_text">Galería</h1>
  </div>
</div>

<div id="owl_carousel" class="container-fluid mx-auto maximum-width" style="font-family: ABeeZee, sans-serif;">
  <h2 class="text-center" style="color: rgb(59, 89, 152);">Infraestructura</h2>
  <div class="owl-carousel owl-theme w-100 mb-4">
    <img class="item" src="{{asset('img/46.jpg')}}" alt="46">
    <img class="item" src="{{asset('img/52x2-1.jpg')}}" alt="51-1">
    <img class="item" src="{{asset('img/52x2-2.jpg')}}" alt="52-2">
    <img class="item" src="{{asset('img/52x2-3.jpeg')}}" alt="52-3">
    <img class="item" src="{{asset('img/area-1.jpg')}}" alt="area-1">
    <img class="item" src="{{asset('img/Guillo-1.jpg')}}" alt="Guillo-1">
    <img class="item" src="{{asset('img/Guillo-2.jpg')}}" alt="Guillo-2">
    <img class="item" src="{{asset('img/redondeadora-1.jpeg')}}" alt="redondeadora-1">
    <img class="item" src="{{asset('img/redondeadora-2.jpeg')}}" alt="redondeadora-2">
    <img class="item" src="{{asset('img/grapadora.jpg')}}" alt="grapadora">
    <img class="item" src="{{asset('img/perforadora.jpeg')}}" alt="perforadora">
    <img class="item" src="{{asset('img/entrada.jpg')}}" alt="entrada">
  </div>
</div>
@endsection

@section('scripts')
<script>
  $(".owl-carousel").owlCarousel({
    loop: true,
    margin: 10,
    // nav: true,
    autoWidth: true,
    autoHeight: true,
    items: 5,
    responsive:{
      0:{
        items:1
      },
      600:{
        items:3
      },
      1000:{
        items:5
      }
    }
  });
</script>
@endsection
