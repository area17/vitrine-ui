{{--<{{ $tag }} {{ $attributes->class(--}}
{{--    VitrineUI::setPrefixedClass([--}}
{{--        'btn',--}}
{{--        'btn--' . $size => $size,--}}
{{--        'btn--' . $variant => $variant,--}}
{{--        'btn--icon' => $iconOnly,--}}
{{--    ]),--}}
{{--) }}--}}
<{{ $tag }} {{ $attributes->class(
    VitrineUI::ui('button', 'base', [
        'size' => $size,
        'variant' => $variant,
        'icon_only' => $iconOnly,
    ]),
) }}
    @if ($href) href="{{ $href }}" @endif
    @if ($target) target="{{ $target }}" @endif>

    @if ($iconBefore())
        <x-vui-icon class="{{ VitrineUI::setPrefixedClass('btn-icon') }}"
                    :name="$icon" />
    @endif

    @if (!$slot->isEmpty())
        <span class="{{ VitrineUI::ui('button', 'label') }}">{{ $slot }}</span>
    @endif

    @if ($iconAfter())
        <x-vui-icon class="{{ VitrineUI::setPrefixedClass('btn-icon') }}"
                    :name="$icon" />
    @endif
    </{{ $tag }}>
