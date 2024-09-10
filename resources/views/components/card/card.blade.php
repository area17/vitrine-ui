<{{$tag}} {{ $attributes->twMerge(
        $ui('card', 'base', [
            'variant' => $variant
        ])
    ) }}>
    {{ $slot }}
</{{$tag}}>
