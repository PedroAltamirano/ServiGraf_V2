@extends('layouts.home', ['txtcolor' => 'text-dark', 'tooglercolor' => 'black'])

@section('home-content')
<div class="container-fluid text-center my-auto" style="max-width: 900px;font-family: ABeeZee, sans-serif;padding: 20px;height: 100%;">
    <div class="row text-center justify-content-center align-items-center h-100 w-100 m-0 my-auto p-0">
        <div class="col-12 text-center align-self-center m-auto" style="margin: 0;padding: 0;">
            <div class="text-center shadow mx-auto" style="max-width: 350px;border-radius: 5px;">
                <div class="text-center text-white blue-bg" style="padding: 8px;border-radius: 5px 5px 0px 0px;">
                    <h5 style="margin: 0px;padding: 0px;">Inicio de Sesión</h5>
                </div>
                <div class="m-3">
                    <form action="{{route('login')}}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <input class="form-control @error('usuario') is-invalid @enderror" type="text" name="usuario" value="{{ old('usuario') }}" placeholder="Nombre" autofocus>
                            @error('usuario')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" value="{{ old('password') }}" placeholder="Contraseña">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <input class="form-control @error('cedula') is-invalid @enderror" type="text" name="cedula" value="{{ old('cedula') }}" placeholder="Cédula">
                            @error('cedula')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button class="btn btn-primary w-100 mb-3" type="submit">Iniciar</button>

                        <div class="d-flex justify-content-between">
                            <div class="form-check my-auto">
                                <label class="form-check-label" for="remember">
                                    <input type="checkbox" class="form-check-input" name="remember" value="true" {{old('remember') ? 'checked':''}}>
                                    Recuérdame
                                </label>
                            </div>
                            <button class="btn btn-success text-white">Ots</button>
                        </div>
                    </form>
                </div>
                <div class="d-flex justify-content-between blue-bg" style="padding: 8px 10px; border-radius: 0px 0px 5px 5px;">
                    <a class="text-white" href="#" style="font-size: 12px;">V 2.11.20</a>
                    <a class="text-white d-sm-flex" href="{{ route('password.request') }}" style="font-size: 12px;">Olvidaste tu contraseña?</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
