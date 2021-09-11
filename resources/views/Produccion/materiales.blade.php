@extends('layouts.app')

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
    ['text'=>'Nuevo', 'href'=>'#modalCat', 'id'=>'nuevo', 'tipo'=>'modal'],
  ]"
>
  <div class="row">
    @foreach ($categorias as $item)
    <div class="col-6 col-md-2">
      <x-crud routeEdit="#modalCat" :modalEdit="$item" />
      &nbsp;&nbsp;{{ $item->categoria }}
    </div>
    @endforeach
  </div>
</x-blue-board>

<x-blue-board
  title='Papeleria'
  :foot="[
    ['text'=>'Nuevo', 'href'=>route('material.create'), 'id'=>'nuevo', 'tipo'=>'link'],
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
          <x-crud :routeEdit="route('material.edit', $item->id)" />
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
    ['text'=>'Nuevo', 'href'=>'#modalTinta', 'id'=>'nuevo', 'tipo'=>'modal'],
  ]"
>
  <div class="row">
    @foreach ($tintas as $item)
    <div class="col-6 col-md-2">
      <x-crud routeEdit="#modalTinta" :modalEdit="$item" />
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
                  <input type="text" name="color" id="color" class="form-control">
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary submitbtn">Crear</button>
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
                  <label for="categoria">Categoria</label>
                  <input type="text" name="categoria" id="categoria" class="form-control">
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary submitbtn">Crear</button>
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
  const routeStore = `{{ route("tinta.store") }}`;
  const routeUpdate = `{{ route("tinta.update", 0) }}`;
  $('#modalTinta').on('show.bs.modal', event => {
    let data = $(event.relatedTarget).data('modaldata');
    let modal = $(event.target);

    let path = data ? routeUpdate.replace('/0', `/${data.id}`) : routeStore;
    modal.find('.modal-title').html(data ? 'Modificar Tinta' : 'Nueva Tinta');
    modal.find('.modal-path').attr('action', path);
    modal.find("input[name='_method']").val(data ? 'PUT' : 'POST');
    modal.find(".submitbtn").html(data ? 'Modificar' : 'Crear');

    modal.find('#color').val(data ? data.color : '');
  });

  // CATEGORIAS
  const routeStoreCat = `{{ route('categoria.store') }}`;
  const routeUpdateCat = `{{ route('categoria.update', 0) }}`;
  $('#modalCat').on('show.bs.modal', event => {
    let data = $(event.relatedTarget).data('modaldata');
    let modal = $(event.target);

    let path = data ? routeUpdateCat.replace('/0', `/${data.id}`) : routeStoreCat;
    modal.find('.modal-title').html(data ? 'Modificar Categoría' : 'Nueva Categoría');
    modal.find('.modal-path').attr('action', path);
    modal.find("input[name='_method']").val(data ? 'PUT' : 'POST');
    modal.find(".submitbtn").html(data ? 'Modificar' : 'Crear');

    modal.find('#categoria').val(data ? data.categoria : '');
  });
</script>
@endsection
