<select name="{{ $name }}" id="{{ $id }}" class="form-control form-control-sm select2Class">
  <option value="none" selected>Selecciona uno...</option>
  @foreach ($usuarios as $user)
    <option value="{{ $user->id }}" @if ($user->id == auth()->id()) selected @endif>
      {{ $user->nomina->full_name }}
    </option>
  @endforeach
</select>
