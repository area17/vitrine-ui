@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <circle cx="14.875" cy="14.875" r="8.58333" stroke="currentColor" stroke-width="1.25"/>
    <path d="M21.25 21.25L26.9167 26.9167" stroke="currentColor" stroke-width="1.25"/>
</g>

@endPushOnce

<x-vui-icon-output
    :size="32"
    :name="$name"
    :aria-label="$ariaLabel ?? null"
/>
