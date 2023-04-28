@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M17.6193 13.8042L16.8163 14.6781L22.6499 20.1456H6.58984V21.3264H22.6499L16.8163 26.8057L17.6193 27.656L24.9998 20.736L17.6193 13.8042Z" fill="currentColor"/>
    <rect x="6.58984" y="4.20361" width="1.18088" height="16.5324" fill="currentColor"/>
</g>

@endPushOnce

<x-vui-icon-output
    :size="32"
    :name="$name"
    :aria-label="$ariaLabel ?? null"
/>
