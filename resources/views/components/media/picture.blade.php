@props([
    'sources' => [],
    'fallBackImg' => null,
    'revealAnimation' => true,
    'loading' => 'lazy',
])
<picture {{ $attributes }}>
    @foreach ($sources as $source)
        @if (Arr::has($source, 'srcSetWebp') ?? false)
            <source srcset="{{ $source['srcSetWebp'] }}"
                    type="image/webp"
                    @if (Arr::has($source, 'media')) media="{{ $source['media'] }}" @endif>
        @endif
        @if (Arr::has($source, 'srcSet') ?? false)
            <source srcset="{{ $source['srcSet'] }}"
                    @if (Arr::has($source, 'media')) media="{{ $source['media'] }}" @endif>
        @endif
    @endforeach
    @if (isset($fallBackImg))
        <x-vui-img :img="$fallBackImg"
                   :loading="$loading"
                   :reveal-animation="$revealAnimation" />
    @endif
</picture>
