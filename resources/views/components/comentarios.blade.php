@foreach ($comentarios as $item)
  <x-chat :avatar="$item->nomina->avatar" :nombre="$item->creador->usuario" :fecha="$item->created_at" :mssg="$item->comentario" :parent_id="$item->id" :modaldata="$item" />
  @if($item->children)
  <div class="ml-5">
    <x-comentarios :comentarios="$item->children" />
  </div>
  @endif
@endforeach
