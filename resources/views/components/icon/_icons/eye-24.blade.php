@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8M1 12s4 8 11 8 11-8 11-8"/><circle cx="12" cy="12" r="3"/></g>
</g>

@endPushOnce

<x-vui-icon-output
    :size="24"
    :name="$name"
    :aria-label="$ariaLabel ?? null"
    {{ $attributes }}
/>
