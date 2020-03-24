@extends('layouts.app')

@section('links')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/b-1.6.1/b-html5-1.6.1/b-print-1.6.1/fc-3.3.0/r-2.2.3/rg-1.1.1/sp-1.0.1/sl-1.3.1/datatables.min.css"/>
@endsection

@section('desktop-content')
<nav aria-label="breadcrumb" class="m-0 p-0 mb-2 mb-md-3">
  <ol class="breadcrumb m-0 p-2 p-md-3">
    <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
  </ol>
</nav>

<board><datatable></datatable></board>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/b-1.6.1/b-html5-1.6.1/b-print-1.6.1/fc-3.3.0/r-2.2.3/rg-1.1.1/sp-1.0.1/sl-1.3.1/datatables.min.js"></script>

<script>
  $('#dataTable').DataTable({
    "responsive": true,
    "ajax": "http://192.168.0.29:3000/data.json",
    "columns": [
      {"data": "nombre"},
      {"data": "usuario"},
      {"data": "correo"},
      {"data": "perfil"},
      {"data": "horario"},
      {"data": "pencil"}
    ],
    /*'rowCallback': function (row, data, index){
      (data.estado == '1') ? $('tr', row).css({'color':'green'}) : $('tr', row).css({'color':'red'});
    },*/
  });
</script>
@endsection