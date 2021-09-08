@extends('layouts.app')

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Actividades',
      'current' => false,
      'href' => route('actividad'),
    ],
    [
      'text' => $text,
      'current' => true,
      'href' => '#',
    ]
  ]"
/>

<x-blue-board
  title='Actividad'
  :foot="[
    ['text' => $action, 'href' => '#', 'id' => 'formSubmit', 'tipo' => 'link'],
  ]"
>
  <form action="{{ $path }}" method="POST" id="form">
    @csrf
    @method($method)
    <div class="form-row">
      <div class="form-group col-12 col-md-3">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control form-control-sm @error('nombre') is-invalid @enderror" value="{{ old('nombre', $actividad->nombre) }}">
      </div>
      <div class="form-group col-12 col-md-3">
        <label for="meta">meta</label>
        <input type="text" name="meta" id="meta" class="form-control form-control-sm @error('meta') is-invalid @enderror" value="{{ old('meta', $actividad->meta) }}">
      </div>
      <div class="form-group col-12 col-md-3">
        <label for="plantilla_id">Plantilla</label>
        <select class="form-control form-control-sm @error('plantilla_id') is-invalid @enderror" name="plantilla_id" id="plantilla_id">
          <option selected>Selecciona uno</option>
          @foreach ($plantillas as $item)
          <option value="{{ $item->id }}" {{ old('plantilla_id', $actividad->plantilla_id) == $item->id ? 'select' : '' }}>{{ $item->nombre }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-12 col-md-3">
        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input @error('evaluacion') is-invalid @enderror" name="evaluacion" id="evaluacion" value="1" {{ old('evaluacion', $actividad->evaluacion ) == '1' ? 'checked' : ''}}>
            Evaluación
          </label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input @error('seguimiento') is-invalid @enderror" name="seguimiento" id="seguimiento" value="1" {{ old('seguimiento', $actividad->seguimiento ) == '1' ? 'checked' : ''}}>
            Seguimiento
          </label>
        </div>
      </div>
    </div>
  </form>
</x-blue-board>
@endsection

@section('scripts')
@endsection
