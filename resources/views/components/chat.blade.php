<div class="d-flex mb-2">
  <div class="">
    @if($avatar != '')
      <img class="avatar rounded-circle" src="{{ $avatar }}" alt="chat message" />
    @else
      <div class="avatar rounded-circle bg-primary text-white d-flex justify-content-center align-items-center text-uppercase h3">
        {{ ucfirst($nombre[0]) }}
      </div>
    @endif
  </div>
  <div class="ml-3">
    <h5>
      {{ $nombre }}
      &middot;
      <small>{{ $fecha }}</small>
      &middot;
      <small><a href="#modalComentario" data-toggle="modal" data-modaldata='@json($modaldata)'>Editar</a></small>
    </h5>
    <p class="m-0">{{ $mssg }}</p>
    <small><a href="#modalComentario" data-toggle="modal" data-parent_id="{{ $parentId }}">Responder</a></small>
  </div>
</div>
