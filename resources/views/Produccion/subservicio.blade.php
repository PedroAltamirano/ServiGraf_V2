@extends('layouts.app')

@section('links')
@endsection

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Procesos',
      'current' => false,
      'href' => route('procesos'),
    ],
    [
      'text' => $text,
      'current' => true,
      'href' => '#',
    ]
  ]"
/>

<x-blueBoard
  :title=$text
  :foot="[
    ['text'=>$action, 'href'=>'#', 'id'=>'formSubmit', 'tipo'=> 'link'],
  ]"
>
  <form action="{{ $path }}" method="POST" id="form">
    @csrf
    @method($method)
    <div class="form-row">
      <div class="form-group col-6 col-md-4">
        <label for="servicio_id">Servico</label>
        <select name="servicio_id" id="servicio_id" class="form-control form-control-sm @error('servicio_id') is-invalid @enderror">
          @foreach ($servicios as $item)
          <option value="{{ $item->id }}" {{ old('servicio_id', $subservicio->servicio_id) == $item->id ? 'selected' : '' }}>{{ $item->servicio }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-12 col-md-4">
        <label for="subservicio">Subservicio</label>
        <input type="text" name="subservicio" id="subservicio" class="form-control form-control-sm @error('subservicio') is-invalid @enderror" value="{{ old('subservicio', $subservicio->subservicio) }}">
      </div>
      <div class="form-group col-6 col-md-4">
        <label for="tipo">Tipo de proceso</label>
        <select name="tipo" id="tipo" class="form-control form-control-sm @error('tipo') is-invalid @enderror">
          <option value="1" {{ old('tipo', $subservicio->tipo) == "1" ? 'selected' : '' }}>Proceso Interno</option>
          <option value="0" {{ old('tipo', $subservicio->tipo) == "0" ? 'selected' : '' }}>Proceso Externo</option>
        </select>
      </div>
      <div class="form-group col-6 col-md-2">
        <label for="tmaquina">T x Máquina</label>
        <input type="time" min="0" name="tmaquina" id="tmaquina" class="form-control form-control-sm @error('tmaquina') is-invalid @enderror" value="{{ old('tmaquina', $subservicio->tmaquina) }}" disabled>
      </div>
      <div class="form-group col-6 col-md-2">
        <label for="toperador">T x operador</label>
        <input type="time" min="0" name="toperador" id="toperador" class="form-control form-control-sm @error('toperador') is-invalid @enderror" value="{{ old('toperador', $subservicio->toperador) }}" disabled>
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