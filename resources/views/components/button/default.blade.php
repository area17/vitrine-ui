<{{ $tag }} {{ $attributes->class(
    $ui('button', 'base', [
        'size' => $size,
        'variant' => $variant,
        'icon_only' => $iconOnly ? 'true' : 'false',
        'icon_position' => $getIconPosition(),
    ]),
) }}
    @if ($href) href="{{ $href }}" @endif
    @if ($target) target="{{ $target }}" @endif>

    @if ($iconBefore())
        <x-vui-icon class="{{ $ui('button', 'icon') }}"
                    :name="$icon" />
    @endif

    @if (!$slot->isEmpty())
        <span class="{{ $ui('button', 'label') }}">{{ $slot }}</span>
    @endif

    @if ($iconAfter())
        <x-vui-icon class="{{ $ui('button', 'icon') }}"
                    :name="$icon" />
    @endif
    </{{ $tag }}>
