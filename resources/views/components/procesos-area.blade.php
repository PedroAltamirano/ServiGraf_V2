<select class='form-control form-control-sm select2Class @error($name) is-invalid @enderror' name='{{ $name }}' id='{{ $id }}' value='{{ old('parent_id', $old) }}'>
  <option value=''>Selecciona uno</option>
  @foreach ($list as $item)
    <optgroup label='{{ $item->first()->area->area }}'>
      @include('components.recusive-options', ['parent' => '', 'column' => 'proceso', 'list' => $item, 'old' => $old, 'with_parent' => 0])
    </optgroup>
  @endforeach
</select>
