@extends('layouts.app')

@section('links')
@endsection

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Nominas',
      'current' => true,
      'href' => '#',
    ]
  ]"
/>

<x-blueBoard
  title='Nominas'
  :foot="[
    ['text'=>'Nuevo', 'href'=>route('nomina.create'), 'id'=>'nuevo', 'tipo'=> 'link']
  ]"
>
  <table id="table" class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Cédula</th>
        <th scope="col">Nombre</th>
        <th scope="col">Telefono</th>
        <th scope="col">Correo</th>
        <th scope="col">Cargo</th>
        <th scope="col">Contrato</th>
        <th scope="col" class="crudCol">Crud</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($nominas as $item)
      <tr>
        <td>{{ $item->cedula }}</td>
        <td>{{ $item->nombre_completo }}</td>
        <td>{{ $item->movil }}</td>
        <td>{{ $item->correo }}</td>
        <td>{{ $item->cargo }}</td>
        <td>{{ $item->inicio_labor }}</td>
        <td>
          <a class='fa fa-edit' href='{{route('nomina.edit', $item->cedula)}}'></a>
        </td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
    </tfoot>
  </table>
</x-blueBoard>
@endsection

@section('scripts')
<script>
  var table = $('#table').DataTable({
    "info": false,
    "paging": true,
    "ordering": true,
    "responsive": true,
  });
</script>
@endsection
