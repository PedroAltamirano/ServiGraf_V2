<!DOCTYPE html>
<html lang="es" style="height: 100%">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="imprenta, quito, gto, tarjetas, facturas, retenciones, papeleria roll ups, gigantografias, marketing impreso">
    <meta name="desription" content="Imprenta con mas de 20 años de experinecia, ubicada en Quito-Ecuador. Realizamos facturas, retenciones, marketing impreso, diseño gráfico.">

    <meta name="autor" content="Pedro Andrés Altamirano López">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- tab icon -->
    <link href="{{ asset('img/sg-2.png') }}" rel="icon" type="text/css">
    
    <title>ServiGraf</title>

    <!-- vue -->
    {{-- <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body style="min-height: 100%; height: 100%;">

    <div id="app" class="h-100">
    <nav class="navbar navbar-dark navbar-expand-md fixed-top navigation-clean-search" id="homenav">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="background-image: url(&quot;img/sg-2.png&quot;);opacity: 1;"></a>
            <button class="navbar-toggler text-white custom-toggler {{$tooglercolor}}" data-toggle="collapse" data-target="#navcol"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse d-xl-flex align-items-xl-start" id="navcol" style="font-family: ABeeZee, sans-serif;">
                <ul class="nav navbar-nav text-center ml-auto" id="nav_items">
                    <li class="nav-item" role="presentation">
                    <a class="nav-link nav-color {{request()->is('/') ? 'active' : ''}} {{$txtcolor}}" href="{{route('welcome')}}">Inicio</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-color {{request()->is('about-us') ? 'active' : ''}} {{$txtcolor}}" href="{{route('about-us')}}">Sobre Nosotros</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-color {{request()->is('services') ? 'active' : ''}} {{$txtcolor}}" href="{{route('services')}}">Servicios</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-color {{request()->is('galery') ? 'active' : ''}} {{$txtcolor}}" href="{{route('galery')}}">Galería</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-color {{request()->is('contact') ? 'active' : ''}} {{$txtcolor}}" href="{{route('contact')}}">Contacto</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-color {{request()->is('login') ? 'active' : ''}} {{$txtcolor}}" href="{{route('login')}}">Usuario</a>
                    </li>
                </ul>
        </div>
        </div>
    </nav>

    <div id="app" class="h-100">
        @yield('home-content')
    </div>

    <div class="fixed-bottom blue-bg" style="margin: 0px; padding: 12px 3%; font-family: ABeeZee, sans-serif;">
        <footer style="margin: 0px;padding: 0px;" class="m-0">
            <ul class="list-inline text-white m-0" style="color: rgb(255,255,255);">
                <li class="list-inline-item text-white float-left d-xl-flex align-items-xl-center">ServiGraf</li>
                <li class="list-inline-item float-right d-xl-flex align-items-xl-center" style="margin: 0px 6px;"><i class="fas fa-envelope"></i>&nbsp;info@servigraf.me<br></li>
                <li class="list-inline-item float-right d-xl-flex align-items-xl-center" style="margin: 0px 6px;"><i class="fab fa-whatsapp"></i>&nbsp;096 939 4891<br></li>
                <li class="list-inline-item float-right d-xl-flex align-items-xl-center" style="margin: 0px 6px;"><i class="fas fa-phone"></i>&nbsp;514 3236</li>
            </ul>
        </footer>
    </div>
    </div><!-- div for vue -->

</body>

</html>