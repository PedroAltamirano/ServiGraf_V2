@if ($routeSee != '#')
<a class='fa fa-eye {{ $classSee }}' href="{{ $routeSee }}" @if($modalSee) data-toggle="modal" data-modaldata='@json($modalSee)' @endif></a>
@endif
@if ($routeEdit != '#')
<a class='fa fa-edit {{ $classEdit }}' href='{{ $routeEdit }}' @if($modalEdit) data-toggle="modal" data-modaldata='@json($modalEdit)' @endif></a>
@endif
@if ($routeDelete != '#')
<a class='fa fa-trash deleteModal' href="#deleteModal" data-toggle="modal" data-route="{{ $routeDelete }}" data-text="{{ $textDelete }}"></a>
@endif
{{ $slot }}
