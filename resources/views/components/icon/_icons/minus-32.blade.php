@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M4 16H28" fill="none" stroke="currentColor" stroke-width="1.25"/>
</g>

@endPushOnce

<x-vui-icon-output
    :size="32"
    :name="$name"
    :aria-label="$ariaLabel ?? null"
    {{ $attributes }}
/>
