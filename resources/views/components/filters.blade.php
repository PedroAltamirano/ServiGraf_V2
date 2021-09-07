<x-blue-board
  title='Filtros'
  :foot="[]"
  class="d-print-none"
>
  @props(['cli'=>true, 'cob'=>true])

  <div class="form-row">
    <div class="col-6 col-md form-group">
      <label for="inicio">Fecha inicial</label>
      <input type="date" name="inicio" id="inicio" class="form-control form-control-sm refresh" value="{{date('Y-m-').'01'}}">
    </div>
    <div class="col-6 col-md form-group">
      <label for="fin">Fecha final</label>
      <input type="date" name="fin" id="fin" class="form-control form-control-sm refresh" value="{{date('Y-m-d')}}">
    </div>

    @if($cli && $clientes!=[])
    <div class="col-12 col-md form-group">
      <label for="cliente">Cliente</label>
      <select name="cliente" id="cliente" class="form-control form-control-sm refresh select2Class">
        <option value="none" selected>Selecciona uno...</option>
        {{ $group =  $clientes->first()->cliente_empresa_id ?? 0 }}
        <optgroup label="{{ $clientes->first()->empresa->nombre ?? 'Sin Clientes' }}">
        @foreach ($clientes as $cli)
          @if ($group != $cli->cliente_empresa_id)
          {{ $group =  $cli->cliente_empresa_id }}
          <optgroup label="{{ $cli->empresa->nombre }}">
          @endif
          <option value="{{ $cli->id }}">
            {{ $cli->contacto->nombre.' '.$cli->contacto->apellido }}
          </option>
        @endforeach
      </select>
    </div>
    @endif

    @if($cob)
    <div class="col-6 col-md form-group">
      <label for="cobro">Cobro</label>
      <select class="form-control form-control-sm refresh" name="cobro" id="cobro">
        <option value="none" selected>Todo</option>
        <option value="1">Pendiente</option>
        <option value="2">Pagado</option>
        <option value="3">Anulado</option>
        <option value="4">Canje</option>
      </select>
    </div>
    @endif

    {{ $slot }}
  </div>
</x-blue-board>
