<div class="row">
  <div class="col-2 col-md-1">
    @if($avatar != '')
    <img class="w-100 embed-responsive embed-responsive-1by1 rounded-circle" src="{{ $avatar }}" alt="chat message" />
    @else
    <div class="w-100 embed-responsive embed-responsive-1by1 bg-primary text-white border rounded-circle d-flex justify-content-center align-items-center text-uppercase h3">
      {{ ucfirst($nombre[0]) }}
    </div>
    @endif
  </div>
  <div class="col-10 col-md-11">
    <h4>{{ $nombre }}</h4>
    <p>{{ $mssg }}</p>
  </div>
</div>
