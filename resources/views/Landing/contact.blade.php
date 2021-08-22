@extends('layouts.home', ['txtcolor' => 'text-img', 'tooglercolor' => 'white'])

@section('home-content')
<div class="jumbotron jumbotron-fluid text-center" id="fondo" style="margin: 0px;font-family: ABeeZee, sans-serif;color: rgb(255,255,255);background-image: url(&quot;{{asset('img/imprenta_fondo1.jpeg')}}&quot;);padding: 0px;">
  <div class="text-center" id="img_overlay" style="background-color: rgba(0, 0, 0, 0.4);opacity: 1;width: 100%;height: 100%;">
      <h1 class="text-center jumbo_text">Contáctenos</h1>
  </div>
</div>
<div class="container-fluid mx-auto maximum-width" style="font-family: ABeeZee, sans-serif;">
  <div class="row" style="color: grey;">
      <div class="col-12 text-left col-md-6 pr-lg-5 mb-3 mb-md-0">
        <h1 style="color: rgb(59, 89, 152);">Contáctanos</h1>
        <h4 class="mt-4">Tienes preguntas?</h4>

        @if(count($errors) > 0)
        <div class="alert alert-danger p-2 pl-4">
          <button type="button" class="close" data-dismiss="alert">x</button>
          <ul class="m-0 p-0">
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
        @endif

        @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert">x</button>
          <strong>{{ $message }}</strong>
        </div>
        @endif

        @if($message = Session::get('danger'))
        <div class="alert alert-danger" role="alert">
          <button type="button" class="close" data-dismiss="alert">x</button>
          <strong>{{ $message }}</strong>
        </div>
        @endif

        <form action="{{route('contact.send')}}" method="post">
          {{csrf_field()}}
          <div class="form-group">
            <input class="form-control my-3" type="text" name="nombre" placeholder="Nombre">
            <input class="form-control my-3" type="text" name="email" placeholder="Email">
            <input class="form-control my-3" type="text" name="asunto" placeholder="Asunto">
            <textarea class="form-control my-3" name="mensaje" rows="3" placeholder="Mensaje"></textarea>
            <button class="btn btn-primary" type="submit" style="width: 100%;">Enviar</button>
          </div>
        </form>
      </div>
      <div class="col-12 col-md-6 pl-lg-5 mb-3 mb-md-0">
          <h1 style="color: rgb(59, 89, 152);"><b>Servi</b>Graf</h1>
          <div class="mt-4">
              <p><i class="far fa-clock"></i>&nbsp;Atención de Lunes a Viernes de:<br>&nbsp; &nbsp; &nbsp;9:00 a 13:00 &amp; 14:00 a 18:00</p>
              <p><i class="fas fa-map-marker-alt"></i>&nbsp;Uruguay N16.66 y Rio de Janeiro</p>
              <p><i class="fas fa-phone"></i>&nbsp;514 3236 &nbsp;&nbsp;<i class="fab fa-whatsapp"></i>&nbsp;096 939 891</p>
              <p><i class="far fa-envelope"></i>&nbsp;info@servigraf.me</p>
              <p><i class="far fa-money-bill-alt"></i>&nbsp;Efectivo &nbsp;&nbsp;<i class="fas fa-university"></i>&nbsp;Transferencias &nbsp;&nbsp;<i class="fab fa-paypal"></i>&nbsp;Pay Pal</p>
              <p><i class="fab fa-facebook"></i>&nbsp;<a href="https://www.facebook.com/ServiGraf-281911858984024/" target="_blank" class="no-decoration">Visítanos en facebook</a></p>
          </div>
      </div>
      <div class="col-12"><iframe allowfullscreen="" frameborder="0" width="100%" height="400" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDqHSgc2vnoWJPoVCHbEMOn--i_T4C7Kpc&amp;q=Uruguay+N16-66+yrio+de+janeiro&amp;zoom=19"></iframe></div>
  </div>
</div>
@endsection
