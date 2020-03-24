@extends('layouts.home', ['txtcolor' => 'text-white', 'tooglercolor' => 'white'])

@section('home-content')
<div class="jumbotron jumbotron-fluid text-center" id="fondo" style="margin: 0px;font-family: ABeeZee, sans-serif;color: rgb(255,255,255);background-image: url(&quot;{{asset('img/imprenta_fondo1.jpeg')}}&quot;);padding: 0px;">
  <div class="text-center" id="img_overlay" style="background-color: rgba(0, 0, 0, 0.4);opacity: 1;width: 100%;height: 100%;">
      <h1 class="text-center jumbo_text">Servicios</h1>
  </div>
</div>
<div class="container-fluid mx-auto maximum-width" style="font-family: ABeeZee, sans-serif;">
  <div class="row justify-content-center" style="color: grey;">
      <div class="col-12 my-auto col-sm-6 col-lg-4 p-4" style="min-height: 230px;height: 230px;">
          <h4><img class="border rounded-circle border-light blue-shadow" src="{{asset('img/46_sqr.jpg')}}" width="100px">&nbsp; GTO 46</h4>
          <p class="mt-3">Formato: 45 x 32.5, monocolor<br> Impreión, numerados, perforados.</p>
      </div>
      <div class="col-12 my-auto col-sm-6 col-lg-4 p-4" style="min-height: 230px;">
          <h4><img class="border rounded-circle border-light blue-shadow" src="{{asset('img/52x2_sqr.jpg')}}" width="100px">&nbsp; GTO 52</h4>
          <p class="mt-3">Formato: 50 x 35, bicolor<br>Impresión.</p>
      </div>
      <div class="col-12 my-auto col-sm-6 col-lg-4 p-4" style="min-height: 230px;">
          <h4><img class="border rounded-circle border-light blue-shadow" src="{{asset('img/Guillo_sqr.jpg')}}" width="100px">&nbsp; Guillotina Polar</h4>
          <p class="mt-3">Formato: 80cm<br></p>
      </div>
      <div class="col-12 my-auto col-sm-6 col-lg-4 p-4" style="min-height: 230px;">
          <h4><img class="border rounded-circle border-light blue-shadow" src="{{asset('img/pantone_sqr.jpg')}}" width="100px">&nbsp; Colores Pantone</h4>
          <p class="mt-3">Preparamos colores pantone.</p>
      </div>
      <div class="col-12 my-auto col-sm-6 col-lg-4 p-4" style="min-height: 230px;">
          <h4><img class="border rounded-circle border-light blue-shadow" src="{{asset('img/terminados_sqr.jpg')}}" width="100px">&nbsp; Terminados Gráficos</h4>
          <p></p>
      </div>
      <div class="col-12 my-auto col-sm-6 col-lg-4 p-4" style="min-height: 230px;">
          <h4><img class="border rounded-circle border-light blue-shadow" src="{{asset('img/redondeadora_sqr.jpeg')}}" width="100px">&nbsp; Redondeadora</h4>
          <p></p>
      </div>
      <div class="col-12 my-auto col-sm-6 col-lg-4 p-4" style="min-height: 230px;">
          <h4><img class="border rounded-circle border-light blue-shadow" src="{{asset('img/grapadora_sqr.jpg')}}" width="100px">&nbsp; Grapadora</h4>
          <p></p>
      </div>
      <div class="col-12 my-auto col-sm-6 col-lg-4 p-4" style="min-height: 230px;">
          <h4><img class="border rounded-circle border-light blue-shadow" src="{{asset('img/perforadora_sqr.jpeg')}}" width="100px">&nbsp; Perforados</h4>
          <p></p>
      </div>
  </div>
</div>
@endsection