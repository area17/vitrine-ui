@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M13.34 10.1299L12.66 10.8699L17.6 15.4999H4V16.4999H17.6L12.66 21.1399L13.34 21.8599L19.59 15.9999L13.34 10.1299Z" fill="currentColor"/>
    <rect x="4" y="2" width="1" height="14" fill="currentColor"/>
</g>

@endPushOnce

<x-vui-icon-output
    :size="24"
    :name="$name"
    :aria-label="$ariaLabel ?? null"
    {{ $attributes }}
/>
