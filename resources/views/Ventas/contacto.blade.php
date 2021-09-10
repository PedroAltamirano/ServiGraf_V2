@extends('layouts.app')

@section('desktop-content')
<x-path
  :items="[
    [
      'text' => 'Contactos',
      'current' => false,
      'href' => route('contacto'),
    ],
    [
      'text' => $contacto->full_name,
      'current' => true,
      'href' => '#',
    ]
  ]"
/>

<x-blue-board
  title='Contacto'
  :foot="[]"
>
  @include('Ventas._contacto')

  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <div class="nav-link">
        <a class="fas fa-plus" href="#modalTarea" data-toggle="modal" ></a>
      </div>
      <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
      <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
      <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
      
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
  </div>
</x-blue-board>
@endsection

@section('modals')
  <x-add-tarea />
@endsection

@section('scripts')
@endsection
