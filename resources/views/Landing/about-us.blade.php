@extends('layouts.home', ['txtcolor' => 'text-white', 'tooglercolor' => 'white'])

@section('home-content')
<div class="jumbotron jumbotron-fluid text-center" id="fondo" style="margin: 0px;font-family: ABeeZee, sans-serif;color: rgb(255,255,255);background-image: url(&quot;{{asset('img/imprenta_fondo1.jpeg')}}&quot;);padding: 0px;">
  <div class="text-center" id="img_overlay" style="background-color: rgba(0, 0, 0, 0.4);opacity: 1;width: 100%;height: 100%;">
      <h1 class="text-center jumbo_text">Sobre &nbsp;Nosotros</h1>
  </div>
</div>
<div class="container-fluid mx-auto maximum-width" style="font-family: ABeeZee, sans-serif;">
  <div class="row d-md-flex justify-content-md-center">
  <div class="col-12 d-block my-auto col-md-6 p-4"><img class="my-auto" src="{{asset('img/servigraf-logo.png')}}" width="100%"></div>
      <div class="col-12 col-md-6 p-4">
          <div></div>
          <h1 class="display-4" style="color: rgb(50, 89, 152);">Servicios Gráficos</h1>
          <p class="lead text-justify" style="color: grey;">Con presencia en el mercado desde el año 2000, nos hemos convertido en una empresa sólida y creciente en el área gráfica, preocupados siempre por mejorar nuestros procesos a fin de entregar un servicio de alta calidad, de acuerdo a las
              exigencias del mercado actual.<br>La experiencia de nuestro personal y su permanente capacitaión nos han mantenido siempre actializados en el constante avance tecnológico.<br>Contamos
              con la infraestructura necesaria para desarrollar sus proyectos gráficos, mas una respuesta rápida y de exelente calidad, nos ha significado el reconocimiento de nuestros clientes.</p>
          <div class="tarjeta p-1 p-md-2 pl-md-4" style="color: grey;">
              <h5>Samuel Altamirano</h5>
              <h5>Grente</h5>
          </div>
      </div>
  </div>
</div>
@endsection