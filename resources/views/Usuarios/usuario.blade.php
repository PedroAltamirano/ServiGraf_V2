@extends('layouts.app')

@section('links')
@endsection

@section('desktop-content')
<path-route
  :items="[
    {
      text: 'Usuarios',
      current: false,
      href: '/usuarios',
    },
    {
      text: '{{ $text }}',
      current: true,
      href: '{{ $path }}',
    }
  ]"
></path-route>

<blue-board
  title='{{ $text }}'
  :foot="[
    {text:'{{ $action }}', href:'#', id:'formSubmit', tipo: 'link'},
  ]"
>

  <form action="{{ $path }}" method="POST" id="form">
    @csrf
    <div class="form-row">
      <div class="form-group col-12 col-md-6">
        <label for="nomina">Nomina</label>
        <select class="custom-select @error('nomina') is-invalid @enderror" name="nomina" id="nomina" {{ session('current.cedula') ? 'disabled':'' }}>
          <option disabled selected>Select one</option>
          {{ $cedula = (old('nomina') ? old('nomina') : session('current.cedula')) }}
          @foreach($nomina as $person)
          <option value="{{ $person->cedula }}"
                  {{ $cedula == $person->cedula ? 'selected':'' }}>
            {{ $person->nombre.' '.$person->apellido }}
          </option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-12 col-md-6">
        <label for="nomina">Usuario</label>
        <input type="text" name="usuario" id="usuario" class="form-control @error('usuario') is-invalid @enderror" placeholder="Usuario" 
        value="{{ old('usuario') ? old('usuario') : session('current.usuario') }}">
      </div>
      <div class="form-group col-12 col-md-6">
        <label for="password">Contraseña</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Contraseña" 
        value="{{ old('password') }}" {{ session('current.password') ? 'disabled':'' }}>
      </div>
      <div class="form-group col-12 col-md-6">
        <label for="password_confirmation">Verificar contraseña</label>
        <input type="password" class="form-control  @error('passwordVer') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Contraseña" 
        value="{{ old('password_confirmation') }}" {{ session('current.password') ? 'disabled':'' }}>
      </div>
      <div class="form-group col-3 col-md-2">
        <label for="perfil_id">Perfil</label>
        <select class="custom-select @error('perfil_id') is-invalid @enderror" name="perfil_id" id="perfil_id">
          <option disabled selected>Select one</option>
          {{ $id = (old('perfil_id') ? old('perfil_id') : session('current.perfil_id')) }}
          @foreach ($perfiles as $perfil)
          <option value="{{ $perfil->id }}" 
                  {{ $id == $perfil->id ? 'selected':'' }}>
            {{ $perfil->perfil }}
          </option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-3 col-md-2">
        <label for="statusDiv">Activo</label>
        <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
          <input type="checkbox" class="custom-control-input @error('status') is-invalid @enderror" id="status" name="status"
          {{ (old('status') ? old('status') : session('current.status')) ? 'checked':'' }}>
          <label class="custom-control-label" for="status"></label>
        </div>
      </div> 
      <div class="form-group col-3 col-md-2">
        <label for="reservarotDiv">Reservar Ot</label>
        <div class="custom-control custom-switch d-flex justify-content-center" name="reservarotDiv">
          <input type="checkbox" class="custom-control-input @error('reservarot') is-invalid @enderror" id="reservarot" name="reservarot"
          {{ (old('reservarot') ? old('reservarot') : session('current.reservarot')) ? 'checked':'' }}>
          <label class="custom-control-label" for="reservarot"></label>
        </div>
      </div> 
      <div class="form-group col-3 col-md-2">
        <label for="libroDiv">Libro</label>
        <div class="custom-control custom-switch d-flex justify-content-center" name="libroDiv">
          <input type="checkbox" class="custom-control-input @error('libro') is-invalid @enderror" id="libro" name="libro"
          {{ (old('libro') ? old('libro') : session('current.libro')) ? 'checked':'' }}>
          <label class="custom-control-label" for="libro"></label>
        </div>
      </div> 
    </div>
  </form>
</blue-board>
@endsection

@section('scripts')
<script>
  $('#formSubmit').click(function(){
    $('#form').submit();
  });
</script>
@endsection
