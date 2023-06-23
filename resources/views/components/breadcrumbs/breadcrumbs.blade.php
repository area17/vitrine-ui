@if(filled($items))
    <{{ $tag ?? 'nav' }} aria-label="breadcrumbs" {{ $attributes->class($ui('breadcrumbs')) }}>
        @foreach ($items as $item)
            @if ($item['href'] ?? null)
                <a
                    class="{{ $ui('breadcrumbs', ['item', 'link']) }}"
                    href="{{$item['href']}}"
                    @if($loop->last)  aria-current="page"  @endif
                >
                    {{ $item['text'] ?? '' }}
                </a>
            @else
                <span class="{{ $ui('breadcrumbs', 'item') }}"
                      @if($loop->last)  aria-current="page"  @endif
                >
                    {{ $item['text'] ?? '' }}
                </span>
            @endif
        @endforeach
    </{{ $tag ?? 'nav' }}>
@endif
