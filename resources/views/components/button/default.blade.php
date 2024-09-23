<{{ $tag }} {{ $attributes->class(
    $ui($uiKeyComponent, 'base', [
        'size' => $size,
        'variant' => $variant,
        'icon_only' => $iconOnly ? 'true' : 'false',
        'icon_position' => $getIconPosition(),
    ]),
) }}
                     @if ($href) href="{{ $href }}" @endif
                     @if ($target) target="{{ $target }}" @endif>

    @if ($iconBefore())
        <x-vui-icon class="{{ $ui($uiKeyComponent, 'icon') }}"
                    :name="$icon" />
    @endif

    @if (!$slot->isEmpty())
        <span class="{{ $ui($uiKeyComponent, 'label') }}">{{ $slot }}</span>
    @endif

    @if ($iconAfter())
        <x-vui-icon class="{{ $ui($uiKeyComponent, 'icon') }}"
                    :name="$icon" />
    @endif
    </{{ $tag }}>
