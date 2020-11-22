@extends('layouts.app')

@section('links')
@endsection

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Perfiles',
      'current' => false,
      'href' => route('perfiles'),
    ],
    [
      'text' => $text,
      'current' => true,
      'href' => $path,
    ]
  ]"
/>

<x-blueBoard
  title='{{ $text }}'
  :foot="[
    ['text'=>$action, 'href'=>'#', 'id'=>'formSubmit', 'tipo'=> 'link']
  ]"
>
  <form action='{{ $path }}' method="POST" id="form">
    @csrf
    @method($method)
    <div class="form-row">
      <div class="form-group col-10 col-md-5 order-1">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre del perfil" aria-describedby="helpId" value="{{ old('nombre', $perfil->nombre) }}">
      </div>
      <div class="form-group col-12 col-md-6 order-3 order-md-2">
        <label for="descripcion">Descripcion</label>
        <input type="text" name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" placeholder="Descripcion del perfil" aria-describedby="helpId" value="{{ old('descripcion', $perfil->descripcion) }}">
      </div>
      <div class="form-group col-2 col-md-1 order-2 order-md-3">
        <label for="statusDiv">Activo</label>
        <div class="custom-control custom-switch d-flex justify-content-center" name="statusDiv">
          <input type="checkbox" class="custom-control-input @error('status') is-invalid @enderror" id="status" name="status" 
          {{ old('status', $perfil->status) == '1' ? 'checked':'' }}>
          <label class="custom-control-label" for="status"></label>
        </div>
      </div>
    </div>

    <div class="dropdown-divider"></div>
    {{$modPerf}}
    <table id="table" class="table table-striped">
      <thead>
        <tr>
          <th scope="col" style="width:33.33%">Modulos del perfil</th>
          <th scope="col" style="width:16.667%" class="text-center">
            <i class="fas fa-eye"></i>&nbsp;
            <span class="d-none d-md-inline">Ver</span></th>
          <th scope="col" style="width:16.667%" class="text-center">
            <i class="fas fa-plus"></i>&nbsp;
            <span class="d-none d-md-inline">Crear</span>
          </th>
          <th scope="col" style="width:16.667%" class="text-center">
            <i class="fas fa-edit"></i>&nbsp;
            <span class="d-none d-md-inline">Modificar</span>
          </th>
          <th scope="col" style="width:16.667%" class="text-center">
            <i class="fas fa-times"></i>&nbsp;
            <span class="d-none d-md-inline">Eliminar</span>
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach ($modules as $item)
        <tr>
          <td class="m-0 {{ $item->principal ? '':'pl-4' }}">{{ $item->nombre }}</td>
          <td>
            <div class="custom-control custom-switch d-flex justify-content-center">
              <input type="checkbox" class="custom-control-input" id="{{ $item->id }}-1" name="{{ $item->id }}-1" 
              {{ old($item->id.'-1') ? 'checked':'' }}>
              <label class="custom-control-label" for="{{ $item->id }}-1"></label>
            </div>
          </td>
          <td>
            <div class="custom-control custom-switch d-flex justify-content-center">
              <input type="checkbox" class="custom-control-input" id="{{ $item->id }}-2" name="{{ $item->id }}-2" 
              {{ old($item->id.'-2') ? 'checked':'' }}>
              <label class="custom-control-label" for="{{ $item->id }}-2"></label>
            </div>
          </td>
          <td>
            <div class="custom-control custom-switch d-flex justify-content-center">
              <input type="checkbox" class="custom-control-input" id="{{ $item->id }}-3" name="{{ $item->id }}-3" 
              {{ old($item->id.'-3') ? 'checked':'' }}>
              <label class="custom-control-label" for="{{ $item->id }}-3"></label>
            </div>
          </td>
          <td>
            <div class="custom-control custom-switch d-flex justify-content-center">
              <input type="checkbox" class="custom-control-input" id="{{ $item->id }}-4" name="{{ $item->id }}-4" 
              {{ old($item->id.'-4') ? 'checked':'' }}>
              <label class="custom-control-label" for="{{ $item->id }}-4"></label>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </form>
</x-blueBoard>
@endsection

@section('scripts')
<script>
  // $(document).ready(function() {
  //   $('#table').DataTable({
  //     "paging":   false,
  //     "ordering": false,
  //     "info":     false,
  //   });
  // });

  $('.custom-control-input').change(function(){
    var id = this.id.split('-');
    if($(this).is(":checked")){
      for(var i=1; i<id[1]; i++){
        var sw = '#' + id[0].toString() + '-' + i.toString();
        $(sw).prop("checked", true);
      }
    } else {
      for(var i=4; i>id[1]; i--){
        var sw = '#' + id[0].toString() + '-' + i.toString();
        $(sw).prop("checked", false);
      }
    }
  });

  // $('#formSubmit').click(function(){
  //   $('#form').submit();
  // });
</script>
@endsection