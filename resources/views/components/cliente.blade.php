<label for="{{ $column }}">Cliente</label>
<select class="form-control form-control-sm refresh select2Class @error($column) is-invalid @enderror"
  name="{{ $column }}" id="{{ $column }}" data-tags="true">
  <option value='none' selected>Selecciona uno...</option>
  {{ $group = $clientes->first()->cliente_empresa_id ?? 0 }}
  <optgroup label="{{ $clientes->first()->empresa->nombre ?? 'Sin Clientes' }}">
    @foreach ($clientes as $cli)
      @if ($group != $cli->cliente_empresa_id)
        {{ $group = $cli->cliente_empresa_id }}
  <optgroup label="{{ $cli->empresa->nombre }}">
    @endif
    <option value="{{ $cli->id }}" {{ $old == $cli->id ? 'selected' : '' }}>
      {{ $cli->contacto->full_name }}
    </option>
    @endforeach
</select>
