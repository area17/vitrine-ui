@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M7.5 4V20L20.5 12L7.5 4ZM8.46511 5.76L18.618 12L8.46511 18.27V5.76Z" fill="currentColor"/>
</g>

@endPushOnce

<x-vui-icon-output
    :size="24"
    :name="$name"
    :aria-label="$ariaLabel ?? null"
    {{ $attributes }}
/>
