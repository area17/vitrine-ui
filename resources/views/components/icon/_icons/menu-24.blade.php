@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M21 12H3V13H21V12Z" fill="currentColor"/>
    <path d="M21 6H3V7H21V6Z" fill="currentColor"/>
    <path d="M21 18H3V19H21V18Z" fill="currentColor"/>
</g>

@endPushOnce

<x-vui-icon-output
    :size="24"
    :name="$name"
    :aria-label="$ariaLabel ?? null"
    {{ $attributes }}
/>
