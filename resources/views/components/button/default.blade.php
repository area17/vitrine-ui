<{{ $element() }}
    {{ $attributes->class([
    'btn',
    'btn--'.$size => $size,
    'btn--'.$variant => $variant,
    'btn--icon' => $iconOnly
    ]) }}
    @if($href) href="{{ $href }}" @endif
    @if($target) target="{{ $target }}" @endif
>
    @if ($iconBefore())
        <x-vui-icon class="btn-icon" :name="$icon" />
    @endif

    @if (!$slot->isEmpty())
        <span class="btn-label">{{ $slot }}</span>
    @endisset

    @if ($iconAfter())
        <x-vui-icon class="btn-icon" :name="$icon" />
    @endif
</{{ $element() }}>
