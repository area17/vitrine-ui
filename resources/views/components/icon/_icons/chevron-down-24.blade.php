@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M11.86 15.94L6 9.69L6.72 9L11.86 14.48L17 9L17.72 9.69L11.86 15.94Z" fill="currentColor"/>
</g>

@endPushOnce

<x-vui-icon-output
    :size="24"
    :name="$name"
    :aria-label="$ariaLabel ?? null"
/>
