<{{$tag}} {{ $attributes->twMerge(
        $ui('card-link', 'base'),
    ) }}
    @if ($href) href="{{ $href }}" @endif
    @if ($target) target="{{ $target }}" @endif>
    {{ $slot }}
</{{$tag}}>
