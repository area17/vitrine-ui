@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M22 4H2V20H22V4ZM4.14645 6.85355L11.6464 14.3536L12 14.7071L12.3536 14.3536L19.8536 6.85355L19.1464 6.14645L12 13.2929L4.85355 6.14645L4.14645 6.85355Z" fill="currentColor"/>
</g>

@endPushOnce

<x-vui-icon-output
    :size="24"
    :name="$name"
    :aria-label="$ariaLabel ?? null"
    {{ $attributes }}
/>
