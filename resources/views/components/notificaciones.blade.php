<li class="nav-item dropdown no-arrow">
  <a class="nav-link dropdown-toggle" id="notificationsDropdown" role="button" data-toggle="dropdown"
    aria-haspopup="true" aria-expanded="false">
    <i class='fas fa-bell fa-fw'></i>
    <span class="badge badge-danger badge-counter">{{ $notificaciones->count() }}</span>
  </a>
  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
    aria-labelledby="notificationsDropdown">
    <h6 class="dropdown-header">
      Message Center
    </h6>
    @foreach ($notificaciones as $item)
      <a class="dropdown-item d-flex align-items-center" href="#">
        <div class="dropdown-list-image mr-3">
          <div class="icon-circle bg-primary">
            <i class="{{ $item['data']['icon'] }} text-white"></i>
          </div>
        </div>
        <div class="font-weight-bold">
          <div class="text-truncate">{{ $item['data']['comentario'] }}</div>
          <div class="small text-muted">{{ $item['data']['de'] }} · {{ $item['data']['contacto'] }}</div>
        </div>
      </a>
    @endforeach
  </div>
</li>
