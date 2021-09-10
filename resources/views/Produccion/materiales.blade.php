@extends('layouts.app')

@section('links')
@endsection

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Materiales',
      'current' => true,
      'href' => route('materiales'),
    ]
  ]"
/>

<x-blue-board
  title='Categorias'
  :foot="[
    ['text'=>'Nuevo', 'href'=>'#modalCat', 'id'=>'newCat', 'tipo'=> 'modal'],
  ]"
>
  <div class="row">
    @foreach ($categorias as $item)
    <div class="col-6 col-md-2">
    <a class="fas fa-edit modCat" href="#modalCat" data-toggle="modal" data-route="{{ route('categoria.update', $item->id) }}" data-color="{{ $item->categoria }}"></a>
      &nbsp;&nbsp;{{ $item->categoria }}
    </div>
    @endforeach
  </div>
</x-blue-board>

<x-blue-board
  title='Papeleria'
  :foot="[
    ['text'=>'Nuevo', 'href'=>route('material.create'), 'id'=>'nuevo', 'tipo'=> 'link'],
  ]"
>
  <table id="tableMat" class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">Categoria</th>
        <th scope="col">Descripción</th>
        <th scope="col">Alto</th>
        <th scope="col">Ancho</th>
        <th scope="col">Precio</th>
        <th scope="col" class="w-5">Color</th>
        <th scope="col" class="w-5">UV</th>
        <th scope="col" class="w-5">Plastificado</th>
        <th scope="col" class="w-5">Crud</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($materiales as $item)
      <tr>
        <td>{{ $item->categoria->categoria }}</td>
        <td>{{ $item->descripcion }}</td>
        <td>{{ $item->alto }}</td>
        <td>{{ $item->ancho }}</td>
        <td>{{ $item->precio }}</td>
        <td><i class="{{ $item->color ? 'fas fa-check' : 'fas fa-times' }}"></i></td>
        <td><i class="{{ $item->uv ? 'fas fa-check' : 'fas fa-times' }}"></i></td>
        <td><i class="{{ $item->plastificado ? 'fas fa-check' : 'fas fa-times' }}"></i></td>
        <td>
          <a class='fa fa-edit' href='{{ route('material.edit', $item->id) }}'></a>
          <a class='fa fa-eye' id="{{ $item->id }}"></a>
        </td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
    </tfoot>
  </table>
</x-blue-board>

<x-blue-board
  title='Tintas'
  :foot="[
    ['text'=>'Nuevo', 'href'=>'#modalTinta', 'id'=>'newTinta', 'tipo'=> 'modal'],
  ]"
>
  <div class="row">
    @foreach ($tintas as $item)
    <div class="col-6 col-md-2">
    <a class="fas fa-edit modTinta" href="#modalTinta" data-toggle="modal" data-route="{{ route('tinta.update', $item->id) }}" data-color="{{ $item->color }}"></a>
      &nbsp;&nbsp;{{ $item->color }}
    </div>
    @endforeach
  </div>
</x-blue-board>
@endsection

@section('modals')
<!-- Modal TINTA -->
<div id="modalTinta" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nueva tinta</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('tinta.store') }}" method="post" class="modal-path">
              @csrf
              @method('POST')
              <div class="modal-body">
                <div class="form-group">
                  <label for="color">Color</label>
                  <input type="text" name="color" id="color" class="form-control modal-color">
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal CATEGORIA -->
<div id="modalCat" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('categoria.store') }}" method="post" class="modal-path">
              @csrf
              @method('POST')
              <div class="modal-body">
                <div class="form-group">
                  <label for="color">Categoria</label>
                  <input type="text" name="categoria" id="categoria" class="form-control modal-color">
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
  $('#tableMat').DataTable({
    "paging":   true,
    "ordering": true,
    "info":     false,
    "responsive": true,
  });

  // TINTAS
  let routeStore = `{{ route("tinta.store") }}`;
  $('#newTinta').click(function(event){
    var modal = $('#modalTinta');
    modal.find('.modal-title').html('Nueva Tinta');
    modal.find('.modal-color').val('');
    modal.find('.modal-path').attr('action', routeStore);
    modal.find('input[name="_method"]').val('POST');
  });

  $('.modTinta').click(function(event){
    var button = $(this);
    var modal = $('#modalTinta');
    modal.find('.modal-title').html('Modificar Tinta');
    modal.find('.modal-color').val(button.data('color'));
    modal.find('.modal-path').attr('action', button.data('route'));
    modal.find('input[name="_method"]').val('PUT');
  });

  // CATEGORIAS
  const routeStoreCat = `{{ route("categoria.store") }}`;
  $('#newCat').click(function(event){
    var modal = $('#modalCat');
    modal.find('.modal-title').html('Nueva Categoria');
    modal.find('.modal-color').val('');
    modal.find('.modal-path').attr('action', routeStoreCat);
    modal.find('input[name="_method"]').val('POST');
  });

  $('.modCat').click(function(event){
    var button = $(this);
    var modal = $('#modalCat');
    modal.find('.modal-title').html('Modificar Categoria');
    modal.find('.modal-color').val(button.data('color'));
    modal.find('.modal-path').attr('action', button.data('route'));
    modal.find('input[name="_method"]').val('PUT');
  });
</script>
@endsection
