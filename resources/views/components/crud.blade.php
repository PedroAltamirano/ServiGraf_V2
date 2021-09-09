@if ($routeSee != '#')
{{-- <a class='fa fa-eye verPedido' data-pedido_id="{{ $item->id }}" id="{{ $item->numero }}" href="#"></a> --}}
<a class='fa fa-eye' href="{{ $routeSee }}" @if($modalSee) data-toggle="modal" data-modaldata="{{ $modalSee }}" @endif></a>
@endif
@if ($routeEdit != '#')
<a class='fa fa-edit' href='{{ $routeEdit }}' @if($modalEdit) data-toggle="modal" data-modaldata="{{ $modalEdit }}" @endif></a>
@endif
@if ($routeDelete != '#')
<a class='fa fa-trash deleteModal' href="#deleteModal" data-toggle="modal" data-route="{{ $routeDelete }}" data-text="{{ $textDelete }}"></a>
@endif
{{ $slot }}
