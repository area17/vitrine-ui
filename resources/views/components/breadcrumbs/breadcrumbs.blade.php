@if(filled($items))
    <{{ $tag ?? 'nav' }} aria-label="breadcrumbs" {{ $attributes->class(VitrineUI::setPrefixedClass('breadcrumbs')) }}>
        @foreach ($items as $item)
            @if ($item['href'] ?? null)
                <x-vui-link
                    class="{{ VitrineUI::setPrefixedClass('breadcrumbs-item') }}"
                    :href="$item['href']"
                    :aria-current="$loop->last ? 'page' : 'false'"
                >
                    {{ $item['text'] ?? '' }}
                </x-vui-link>
            @else
                <span class="{{ VitrineUI::setPrefixedClass('breadcrumbs-item') }}"
                      aria-current="{{$loop->last ? 'page' : 'false'}}"
                >
                    {{ $item['text'] ?? '' }}
                </span>
            @endif
        @endforeach
    </{{ $tag ?? 'nav' }}>
@endif
