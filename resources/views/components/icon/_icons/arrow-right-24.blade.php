@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M14.84 6.12988L14.16 6.86988L19.1 11.4999H4V12.4999H19.1L14.16 17.1399L14.84 17.8599L21.09 11.9999L14.84 6.12988Z" fill="currentColor"/>
</g>

@endPushOnce

<x-vui-icon-output
    :size="24"
    :name="$name"
    :aria-label="$ariaLabel ?? null"
    {{ $attributes }}
/>
