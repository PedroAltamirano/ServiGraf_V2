@extends('layouts.app')

@section('links')
@endsection

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Usuarios',
      'current' => false,
      'href' => route('usuarios'),
    ],
    [
      'text' => $text,
      'current' => true,
      'href' => $path,
    ]
  ]"
/>

<x-blueBoard
  :title="$text"
  :foot="[
    ['text'=>$action, 'href'=>'#', 'id'=>'formSubmit', 'tipo'=>'link']
  ]"
>

  <form action="{{ $path }}" method="POST" id="form">
    @csrf
    @method($method)
    <div class="form-row">
      <div class="form-group col-12 col-md-6">
        <label for="cedula">Nomina</label>
        <select class="custom-select @error('cedula') is-invalid @enderror" name="cedula" id="cedula" {{ session('current.cedula') ? 'disabled':'' }}>
          <option disabled selected>Select one</option>
          {{ $cedula = old('cedula', $usuario->cedula) }}
          @foreach($nomina as $person)
          <option value="{{ $person->cedula }}" {{ $cedula == $person->cedula ? 'selected':'' }}>
            {{ $person->nombre.' '.$person->apellido }}
          </option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-12 col-md-6">
        <label for="nomina">Usuario</label>
        <input type="text" name="usuario" id="usuario" class="form-control @error('usuario') is-invalid @enderror" placeholder="Usuario"
        value="{{ old('usuario', $usuario->usuario) }}">
      </div>
      <div class="form-group col-12 col-md-6">
        <label for="password">Contraseña</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Contraseña"
        value="{{ old('password') }}" {{ isset($usuario->password) ? 'disabled':'' }}>
      </div>
      <div class="form-group col-12 col-md-6">
        <label for="password_confirmation">Verificar contraseña</label>
        <input type="password" class="form-control  @error('passwordVer') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Contraseña"
        value="{{ old('password_confirmation') }}" {{ isset($usuario->password) ? 'disabled':'' }}>
      </div>
      <div class="form-group col-6 col-md-4">
        <label for="perfil_id">Perfil</label>
        <select class="custom-select @error('perfil_id') is-invalid @enderror" name="perfil_id" id="perfil_id">
          <option disabled selected>Select one</option>
          {{ $id = old('perfil_id', $usuario->perfil_id) }}
          @foreach ($perfiles as $perfil)
          <option value="{{ $perfil->id }}" {{ $id == $perfil->id ? 'selected':'' }}>
            {{ $perfil->nombre }}
          </option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-6 col-md-4">
        <label for="procesos">Procesos</label>
        <select class="custom-select select2Class @error('procesos') is-invalid @enderror" name="procesos[]" id="procesos" multiple>
          <option disabled>Select one</option>
          @php($array = old('procesos') ?? $usuario->procesos->pluck('id')->toArray())
          @foreach ($procesos as $item)
          <option value="{{ $item->id }}" {{ in_array($item->id, $array) ? 'selected':'' }}>
            {{ $item->proceso }}
          </option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-6 col-md-4">
        <label for="actividades">Actividades</label>
        <select class="custom-select select2Class @error('actividades') is-invalid @enderror" name="actividades[]" id="actividades" disabled multiple>
          <option disabled>Select one</option>
          @php($array = old('actividades', $usuario->actividades) ?? [])
          @foreach ($actividades as $item)
          <option value="{{ $item->id }}" {{ in_array($item->id, $array) ? 'selected':'' }}>
            {{ $item->nombre }}
          </option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-6 col-md-4">
        <label for="clientes">Clientes Seguimiento</label>
        <select class="custom-select select2Class @error('clientes') is-invalid @enderror" name="clientes[]" id="clientes" multiple>
          <option disabled>Select one</option>
          @php($array = old('clientes') ?? $usuario->clientes->map(function($c){return $c->id;})->toArray())
          @foreach ($clientes as $item)
          <option value="{{ $item->id }}" {{ in_array($item->id, $array) ? 'selected':'' }}>
            {{ $item->contacto->nombre.' '.$item->contacto->apellido.' / '.$item->empresa->nombre }}
          </option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-3 col-md-2">
        <label for="statusDiv">Activo</label>
        <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
          <input type="checkbox" class="custom-control-input @error('status') is-invalid @enderror" id="status" name="status" {{ old('status', $usuario->status) == '1' ? 'checked':'' }} value='1'>
          <label class="custom-control-label" for="status"></label>
        </div>
      </div>
      <div class="form-group col-3 col-md-2">
        <label for="utilidadDiv">Utilidad</label>
        <div class="custom-control custom-switch d-flex justify-content-center" name="utilidadDiv">
          <input type="checkbox" class="custom-control-input @error('utilidad') is-invalid @enderror" id="utilidad" name="utilidad" {{ old('utilidad', $usuario->utilidad) == '1' ? 'checked':'' }} value='1'>
          <label class="custom-control-label" for="utilidad"></label>
        </div>
      </div>
      <div class="form-group col-3 col-md-2">
        <label for="reservarotDiv">Reservar Ot</label>
        <div class="custom-control custom-switch d-flex justify-content-center" name="reservarotDiv">
          <input type="checkbox" class="custom-control-input @error('reservarot') is-invalid @enderror" id="reservarot" name="reservarot" {{ old('reservarot', $usuario->reservarot) == '1' ? 'checked':'' }} value='1'>
          <label class="custom-control-label" for="reservarot"></label>
        </div>
      </div>
      <div class="form-group col-3 col-md-2">
        <label for="libroDiv">Libro</label>
        <div class="custom-control custom-switch d-flex justify-content-center" name="libroDiv">
          <input type="checkbox" class="custom-control-input @error('libro') is-invalid @enderror" id="libro" name="libro"
          {{ old('libro', $usuario->libro) == '1' ? 'checked':'' }} value='1'>
          <label class="custom-control-label" for="libro"></label>
        </div>
      </div>
    </div>
  </form>
</x-blueBoard>
@endsection

@section('scripts')
<script>
  $('#formSubmit').click(function(){
    $('#form').submit();
  });
</script>
@endsection
