<div class="d-flex">
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
    <h4>{{ $nombre }}</h4>
    <p>{{ $mssg }}</p>
  </div>
</div>
