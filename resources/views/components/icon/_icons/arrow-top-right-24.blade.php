@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M10.0205 6.2251L10.0629 7.22919L16.8299 7.00999L6.15263 17.6873L6.85974 18.3944L17.5371 7.71709L17.3249 14.4912L18.3149 14.5195L18.5906 5.9564L10.0205 6.2251Z" fill="currentColor"/>
</g>

@endPushOnce

<x-vui-icon-output
    :size="24"
    :name="$name"
    :aria-label="$ariaLabel ?? null"
/>
