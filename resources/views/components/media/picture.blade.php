@props([
    'sources' => [],
    'src' => null,
    'alt' => null,
    'width' => null,
    'height' => null,
    'fallBackImg' => null,
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
                   :src="$src ?? null"
                   :width="$width ?? null"
                   :height="$height ?? null"
                   :alt="$alt ?? null"
                   :loading="$loading" />
    @endif
</picture>
