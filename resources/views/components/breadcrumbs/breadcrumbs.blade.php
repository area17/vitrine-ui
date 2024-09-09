@if(filled($items))
    <{{ $tag ?? 'nav' }} aria-label="breadcrumbs" {{ $attributes->twMerge($ui('breadcrumbs')) }}>
        @foreach ($items as $item)
            @if ($item['href'] ??  $item['url'] ?? null)
                <a
                    class="{{ $ui('breadcrumbs', ['item', 'link']) }}"
                    href="{{$item['href'] ?? $item['url']}}"
                    @if($loop->last)  aria-current="page"  @endif
                >
                    {{ $item['text'] ?? $item['label'] ?? '' }}
                </a>
            @else
                <span class="{{ $ui('breadcrumbs', 'item') }}"
                      @if($loop->last)  aria-current="page"  @endif
                >
                    {{ $item['text'] ?? $item['label'] ?? '' }}
                </span>
            @endif
        @endforeach
    </{{ $tag ?? 'nav' }}>
@endif
