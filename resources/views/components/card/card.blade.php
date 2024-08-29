<{{$tag}} {{ $attributes->class(
        $ui('card', 'base', [
            'variant' => $variant
        ])
    ) }}>
    {{ $slot }}
</{{$tag}}>
