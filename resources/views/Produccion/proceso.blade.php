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

<x-blue-board
  :title=$text
  :foot="[
    ['text'=>$action, 'href'=>'#', 'id'=>'formSubmit', 'tipo'=>'link'],
  ]"
>
  <form action="{{ $path }}" method="POST" id="form">
    @csrf
    @method($method)
    <div class="form-row">
      <div class="form-group col-6 col-md-4">
        <label for="area_id">Área</label>
        <select name="area_id" id="area_id" class="form-control form-control-sm @error('area_id') is-invalid @enderror">
          @foreach ($areas as $item)
          <option value="{{ $item->id }}" {{ old('area_id', $proceso->area_id) == $item->id ? 'selected' : '' }}>{{ $item->area }}</option>
          @endforeach
        </select>
      </div>

      <x-procesos label='Proceso padre' name='parent_id' :old="old('parent_id', $proceso->parent_id)" />

      <div class="form-group col-12 col-md-4">
        <label for="proceso">Proceso</label>
        <input type="text" name="proceso" id="proceso" class="form-control form-control-sm @error('proceso') is-invalid @enderror" value="{{ old('proceso', $proceso->proceso) }}">
      </div>
      <div class="form-group col-6 col-md-4">
        <label for="meta">Meta $</label>
        <input type="number" step="0.01" min="0" name="meta" id="meta" class="form-control form-control-sm fixFloat @error('meta') is-invalid @enderror" value="{{ old('meta', $proceso->meta) }}">
      </div>
      <div class="form-group col-6 col-md-4">
        <label for="tipo">Tipo de proceso</label>
        <select name="tipo" id="tipo" class="form-control form-control-sm @error('tipo') is-invalid @enderror">
          <option value="1" {{ old('tipo', $proceso->tipo) == "1" ? 'selected' : '' }}>Proceso Interno</option>
          <option value="0" {{ old('tipo', $proceso->tipo) == "0" ? 'selected' : '' }}>Proceso Externo</option>
        </select>
      </div>
      <div class="form-group col-6 col-md-2">
        <label for="tmaquina">T x Máquina</label>
        <input type="time" min="0" name="tmaquina" id="tmaquina" class="form-control form-control-sm @error('tmaquina') is-invalid @enderror" value="{{ old('tmaquina', $proceso->tmaquina) }}" disabled>
      </div>
      <div class="form-group col-6 col-md-2">
        <label for="toperador">T x operador</label>
        <input type="time" min="0" name="toperador" id="toperador" class="form-control form-control-sm @error('toperador') is-invalid @enderror" value="{{ old('toperador', $proceso->toperador) }}" disabled>
      </div>
      <div class="form-group col-3 col-md-2">
        <label for="seguimiento">seguimiento</label>
        <div class="custom-control custom-switch d-flex justify-content-center" name="seguimientoDiv">
          <input type="checkbox" class="custom-control-input @error('seguimiento') is-invalid @enderror" id="seguimiento" name="seguimiento" {{ old('seguimiento', $proceso->seguimiento) == '1' ? 'checked':'' }} value='1'>
          <label class="custom-control-label" for="seguimiento"></label>
        </div>
      </div>
    </div>
  </form>
</x-blue-board>
@endsection
