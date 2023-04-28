@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M8 4H7V20H8V4Z" fill="currentColor"/>
    <path d="M17 4H16V20H17V4Z" fill="currentColor"/>
</g>

@endPushOnce

<x-vui-icon-output
    :size="24"
    :name="$name"
    :aria-label="$ariaLabel ?? null"
/>
