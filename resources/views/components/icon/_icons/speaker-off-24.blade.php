@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M3 7.99977V15.9998H7.83L12 20.2398V3.75977L7.83 7.99977H3ZM11 6.24977V17.7498L8.32 14.9998H4V8.99977H8.32L11 6.24977Z" fill="currentColor"/>
    <path d="M15 9L21 15" stroke="currentColor"/>
    <path d="M21 9L15 15" stroke="currentColor"/>
</g>

@endPushOnce

<x-vui-icon-output
    :size="24"
    :name="$name"
    :aria-label="$ariaLabel ?? null"
/>
