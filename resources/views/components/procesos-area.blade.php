<select class='form-control form-control-sm select2Class @error($name) is-invalid @enderror' name='{{ $name }}' id='{{ $id }}' value='{{ old('parent_id', $old) }}'>
  <option value=''>Selecciona uno</option>
  @foreach ($list as $item)
    @empty(!$item)
    <optgroup label='{{ $item->area }}'>
      @include('components.recusive-options', ['parent' => '', 'column' => 'proceso', 'list' => $item->procesos, 'old' => $old, 'with_parent' => 0])
    </optgroup>
    @endempty
  @endforeach
</select>
