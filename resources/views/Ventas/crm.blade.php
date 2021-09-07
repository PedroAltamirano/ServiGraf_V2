@extends('layouts.app')

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'CRM',
      'current' => true,
      'href' => '#',
    ]
  ]"
/>

<x-blueBoard
  title='Tareas'
  :foot="[
    ['text'=>'Nueva', 'href'=>'#modalTarea', 'id'=>'newTarea', 'tipo'=> 'modal'],
  ]"
>
  <x-aditionalInfo text='Atrasadas' />
  <table id="table" class="table table-striped table-sm">
    <thead>
    </thead>
    <tbody>
      {{-- @foreach ($atrasadas as $item)
      <tr>
        <td>{{ $item-> }}</td>
        <td>
          <x-crud :routeSee='route(.edit, [$->id])', :modalSee='$model', :routeEdit='route(.edit, [$->id])', :modalEdit='$model', :routeDelete='route(.edit, [$->id])' />
        </td>
      </tr>
      @endforeach --}}
    </tbody>
    <tfoot>
    </tfoot>
  </table>

  <x-aditionalInfo text='Hoy' />
  <table id="table" class="table table-striped table-sm">
    <thead>
    </thead>
    <tbody>
      {{-- @foreach ($hoy as $item)
      <tr>
        <td>{{ $item-> }}</td>
        <td>
          <x-crud :routeSee='route(.edit, [$->id])', :modalSee='$model', :routeEdit='route(.edit, [$->id])', :modalEdit='$model', :routeDelete='route(.edit, [$->id])' />
        </td>
      </tr>
      @endforeach --}}
    </tbody>
    <tfoot>
    </tfoot>
  </table>

  <x-aditionalInfo text='Semana' />
  <table id="table" class="table table-striped table-sm">
    <thead>
    </thead>
    <tbody>
      {{-- @foreach ($semana as $item)
      <tr>
        <td>{{ $item-> }}</td>
        <td>
          <x-crud :routeSee='route(.edit, [$->id])', :modalSee='$model', :routeEdit='route(.edit, [$->id])', :modalEdit='$model', :routeDelete='route(.edit, [$->id])' />
        </td>
      </tr>
      @endforeach --}}
    </tbody>
    <tfoot>
    </tfoot>
  </table>

  <x-aditionalInfo text='Proximas' />
  <table id="table" class="table table-striped table-sm">
    <thead>
    </thead>
    <tbody>
      {{-- @foreach ($proximas as $item)
      <tr>
        <td>{{ $item-> }}</td>
        <td>
          <x-crud :routeSee='route(.edit, [$->id])', :modalSee='$model', :routeEdit='route(.edit, [$->id])', :modalEdit='$model', :routeDelete='route(.edit, [$->id])' />
        </td>
      </tr>
      @endforeach --}}
    </tbody>
    <tfoot>
    </tfoot>
  </table>
</x-blueBoard>

@endsection

@section('scripts')
@endsection
