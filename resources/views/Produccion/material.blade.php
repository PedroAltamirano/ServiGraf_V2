@extends('layouts.app')

@section('desktop-content')
  <x-path
    :items="[ ['text' => 'Materiales', 'current' => false, 'href' => route('materiales')],['text' => $text, 'current' => true, 'href' => '#'] ]" />

  <x-blue-board :title=$text
    :foot="[ ['text'=>$action, 'href'=>'#', 'id'=>'formSubmit', 'tipo'=>'link'], ['text' => 'Nuevo', 'href' => route('material.create'), 'id' => 'new', 'tipo' => 'link', 'condition' => $material->id ?? 0] ]">
    <form action="{{ $path }}" method="POST" id="form">
      @csrf
      @method($method)
      <div class="form-row">
        <div class="form-group col-6 col-md-4">
          <label for="categoria_id">Categoria</label>
          <select name="categoria_id" id="categoria_id"
            class="form-control form-control-sm @error('categoria_id') is-invalid @enderror">
            @foreach ($categorias as $item)
              <option value="{{ $item->id }}"
                {{ old('categoria_id', $material->categoria_id) == $item->id ? 'selected' : '' }}>
                {{ $item->categoria }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-12 col-md-4">
          <label for="descripcion">Descripción</label>
          <input type="text" name="descripcion" id="descripcion"
            class="form-control form-control-sm @error('descripcion') is-invalid @enderror"
            value="{{ old('descripcion', $material->descripcion) }}">
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="alto">Alto</label>
          <input type="number" step="0.01" min="0" name="alto" id="alto"
            class="form-control form-control-sm fixFloat @error('alto') is-invalid @enderror"
            value="{{ old('alto', $material->alto) }}">
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="ancho">Ancho</label>
          <input type="number" step="0.01" min="0" name="ancho" id="ancho"
            class="form-control form-control-sm fixFloat @error('ancho') is-invalid @enderror"
            value="{{ old('ancho', $material->ancho) }}">
        </div>
        <div class="form-group col-6 col-md-2">
          <label for="precio">Precio</label>
          <input type="number" step="0.0001" min="0" name="precio" id="precio"
            class="form-control form-control-sm fixFloat @error('precio') is-invalid @enderror"
            value="{{ old('precio', $material->precio) }}">
        </div>
        <div class="form-group col-3 col-md-2">
          <label for="color">Color</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="color">
            <input type="checkbox" class="custom-control-input @error('color') is-invalid @enderror" id="color"
              name="color" {{ old('color', $material->color) == '1' ? 'checked' : '' }} value='1'>
            <label class="custom-control-label" for="color"></label>
          </div>
        </div>
        <div class="form-group col-3 col-md-2">
          <label for="uv">UV</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="uvDiv">
            <input type="checkbox" class="custom-control-input @error('uv') is-invalid @enderror" id="uv" name="uv"
              {{ old('uv', $material->uv) == '1' ? 'checked' : '' }} value='1'>
            <label class="custom-control-label" for="uv"></label>
          </div>
        </div>
        <div class="form-group col-3 col-md-2">
          <label for="plastificado">Plastificado</label>
          <div class="custom-control custom-switch d-flex justify-content-center" name="plastificadoDiv">
            <input type="checkbox" class="custom-control-input @error('plastificado') is-invalid @enderror"
              id="plastificado" name="plastificado"
              {{ old('plastificado', $material->plastificado) == '1' ? 'checked' : '' }} value='1'>
            <label class="custom-control-label" for="plastificado"></label>
          </div>
        </div>
      </div>
    </form>
  </x-blue-board>
@endsection
