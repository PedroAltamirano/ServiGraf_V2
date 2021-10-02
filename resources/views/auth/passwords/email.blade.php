@extends('layouts.home', ['txtcolor' => 'text-noimg', 'tooglercolor' => 'black'])

@section('home-content')
  <div class="container-fluid my-auto"
    style="max-width: 900px; font-family: ABeeZee, sans-serif;padding: 20px;height: 100%;">
    <div class="row text-center justify-content-center align-items-center h-100"
      style="width: 100%;height: 100%;margin: 0px;padding: 0px;margin-top: auto;margin-bottom: auto;">
      <div class="col-12 text-center align-self-center m-auto" style="margin: 0;padding: 0;">
        <div class="text-center border-primary shadow mx-auto" style="max-width: 350px;">
          <div class="card-header blue-bg text-white">Resetear contraseña</div>

          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
              @csrf

              <div class="form-group">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                  value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>

                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary">Enviar link</button>
              </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection
