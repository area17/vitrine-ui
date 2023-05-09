@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M21 15H3V16H21V15Z" fill="currentColor"/>
    <path d="M21 9H3V10H21V9Z" fill="currentColor"/>
    <path d="M16 17.5C17.1046 17.5 18 16.6046 18 15.5C18 14.3954 17.1046 13.5 16 13.5C14.8954 13.5 14 14.3954 14 15.5C14 16.6046 14.8954 17.5 16 17.5Z" fill="#E4E1DC" stroke="currentColor" stroke-miterlimit="10"/>
    <path d="M8 11.5C9.10457 11.5 10 10.6046 10 9.5C10 8.39543 9.10457 7.5 8 7.5C6.89543 7.5 6 8.39543 6 9.5C6 10.6046 6.89543 11.5 8 11.5Z" fill="#E4E1DC" stroke="currentColor" stroke-miterlimit="10"/>
</g>

@endPushOnce

<x-vui-icon-output
    :size="24"
    :name="$name"
    :aria-label="$ariaLabel ?? null"
    {{ $attributes }}
/>
