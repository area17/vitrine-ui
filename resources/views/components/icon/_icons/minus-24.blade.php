@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M20 11.5H4V12.5H20V11.5Z" fill="currentColor"/>
</g>

@endPushOnce

<x-vui-icon-output
    :size="24"
    :name="$name"
    :aria-label="$ariaLabel ?? null"
    {{ $attributes }}
/>
