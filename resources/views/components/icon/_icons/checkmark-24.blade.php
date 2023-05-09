@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M19.9282 5L11.9282 18.8564L5 14.8564" stroke="currentColor"/>
</g>

@endPushOnce

<x-vui-icon-output
    :size="24"
    :name="$name"
    :aria-label="$ariaLabel ?? null"
    {{ $attributes }}
/>
