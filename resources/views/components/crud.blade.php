@if ($routeSee != '#') <a class='@if (!$status) text-danger @endif' href="{{ $routeSee }}" @if ($modalSee) data-toggle="modal" data-modaldata='@json($modalSee)' @endif>
<i class="fa fa-eye"></i>
</a> @endif

@if ($routeEdit != '#') <a class='@if (!$status) text-danger @endif' href='{{ $routeEdit }}' @if ($modalEdit) data-toggle="modal" data-modaldata='@json($modalEdit)' @endif>
<i class="fa fa-edit"></i>
</a> @endif

@if ($routeDelete != '#') <a class='@if (!$status) text-danger @endif deleteModal' href="#deleteModal" data-toggle="modal" data-route="{{ $routeDelete }}"
data-text="{{ $textDelete }}">
<i class="fa fa-trash"></i>
</a>
@endif

{{ $slot }}
