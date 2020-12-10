<div class="m-2 m-md-3">
    <div style="background-color: rgba(59,89,152,.8)" class="text-white rounded-top p-2">{{ $title }}</div>
    <div class="p-2 p-md-3 m-0 border-left border-right">{{ $slot }}</div>
    <div class="bg-gray rounded-bottom p-2">
        <div class="d-flex">
            <div class="flex-grow-1 d-flex">
                @foreach ($foot as $item)
                <div class="mr-2 mr-md-3">
                    @if ($item['tipo'] == 'link')
                    <a id="{{ $item['id'] }}" href="{{ $item['href'] }}" class="text-blue-8">{{ $item['text'] }} <i class="fas fa-arrow-alt-circle-right fa-md"></i></a>
                    @elseif ($item['tipo'] == 'modal')
                    <a id="{{ $item['id'] }}" href="{{ $item['href'] }}" class="text-blue-8" data-toggle="modal">{{ $item['text'] }} <i class="fas fa-arrow-alt-circle-right fa-md"></i></a>
                    @endif
                </div>
                @endforeach
            </div>
            <div class="ml-2 ml-md-3">
                @foreach ($foot as $item)
                <div class="mr-2 mr-md-3">
                    @if ($item['tipo'] == 'button')
                    <a onclick="{{ $item['href'] }}" class="{{ $item['text'] }}" id="{{ $item['id'] }}"></a>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>