@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M17.5811 8L16.6652 9.00938L23.3194 15.3248H5V16.6888H23.3194L16.6652 23.0179L17.5811 24L26 16.0068L17.5811 8Z" fill="currentColor"/>
</g>

@endPushOnce

<x-vui-icon-output
    :size="32"
    :name="$name"
    :aria-label="$ariaLabel ?? null"
    {{ $attributes }}
/>
