<{{$tag}} {{ $attributes->optimizedMerge(
        $ui('card', 'base', [
            'variant' => $variant
        ])
    ) }}>
    {{ $slot }}
    </{{ $tag }}>
