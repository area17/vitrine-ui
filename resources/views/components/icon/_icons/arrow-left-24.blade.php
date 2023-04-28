@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M10.2498 17.8599L10.9298 17.1199L5.98984 12.4899L21.0898 12.4899L21.0898 11.4899L5.98984 11.4899L10.9298 6.84986L10.2498 6.12986L3.99984 11.9899L10.2498 17.8599Z" fill="currentColor"/>
</g>

@endPushOnce

<x-vui-icon-output
    :size="24"
    :name="$name"
    :aria-label="$ariaLabel ?? null"
/>
