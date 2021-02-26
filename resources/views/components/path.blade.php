<nav class="m-2 m-md-3 p-0 d-print-none" aria-label="breadcrumb">
  <ol class="breadcrumb">
    {{-- <li v-for='e in links' :key="e.href" :class="['breadcrumb-item']"><a :href="e.href">{{e.text.toUpperCase()}}</a></li>
    <li v-for='e in currentL' :key="e.href" :class="['breadcrumb-item', 'active']" aria-current="page">{{e.text.toUpperCase()}}</li> --}}
    @foreach ($items as $item)
    @if ($item['current'])
    <li class="breadcrumb-item">{{ Str::of($item['text'])->upper() }}</li>
    @else
    <li class="breadcrumb-item active"><a href="{{ $item['href'] }}">{{ Str::of($item['text'])->upper() }}</a></li>
    @endif
    @endforeach
    {{ $slot }}
  </ol>
</nav>
