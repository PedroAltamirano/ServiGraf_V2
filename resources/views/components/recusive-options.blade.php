@foreach ($list as $item)
  {{-- @if ($item->childs->count()) --}}
  @if ($item->children->count())
    @if ($with_parent)
    <option value='' {{ $old == $item->id ? 'selected' : '' }}>{{ $parent.$item->attributes[$column] }}</option>
    @endif
    @include('components.recusive-options', ['parent' => $parent.$item->attributes[$column].' / ', 'column' => $column, 'list' => $item->children()->orderBy($column)->get(), 'old' => $old, 'with_parent' => $with_parent])
  @else
    <option value='{{ $item->id }}' {{ $old == $item->id ? 'selected' : '' }}>{{ $parent.$item->attributes[$column] }}</option>
  @endif
@endforeach
