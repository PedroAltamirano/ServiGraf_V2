<div class="form-group col-6 col-md-4">
  <label for="procesos">{{ $label }}</label>
  <select class="form-control form-control-sm select2Class @error($name) is-invalid @enderror" name="{{ $name }}" id="procesos" value="{{ old('parent_id', $old) }}">
    <option value="">Selecciona uno</option>
    @include('components.recusive-options', ['parent' => '', 'column' => 'proceso', 'list' => $list, 'old' => $old, 'with_parent' => 1])
  </select>
</div>
