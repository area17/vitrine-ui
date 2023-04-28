@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M20 11.5H12.5V4H11.5V11.5H4V12.5H11.5V20H12.5V12.5H20V11.5Z" fill="currentColor"/>
</g>

@endPushOnce

<x-vui-icon-output
    :size="24"
    :name="$name"
    :aria-label="$ariaLabel ?? null"
/>
