<div class="dropdown dropup floating-action-button">
  <button type="button" class="btn btn-primary btn-lg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
      <i class="fa fa-plus" aria-hidden="true"></i>
  </button>
  <ul class="dropdown-menu dropdown-menu-right">
    <li>
        <a href="{{route('libro')}}" class="btn btn-primary bg-primary-80 btn-lg mb-2">
            <i class="fa fa-book" aria-hidden="true"></i>
        </a>
    </li>
    <li>
        <a href="{{route('factura.create')}}" class="btn btn-primary bg-primary-80 btn-lg mb-2">
            <i class="fas fa-chart-line"></i>
        </a>
    </li>
    <li>
        <a href="{{route('pedido.create')}}" class="btn btn-primary bg-primary-80 btn-lg">
            <i class="fa fa-cog" aria-hidden="true"></i>
        </a>
    </li>
  </ul>
</div>
