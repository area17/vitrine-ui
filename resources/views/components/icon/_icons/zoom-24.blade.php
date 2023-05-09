@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M7.1875 10.6875H14.1875" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M10.6875 7.1875V14.1875" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M10.75 19.75C15.7206 19.75 19.75 15.7206 19.75 10.75C19.75 5.77944 15.7206 1.75 10.75 1.75C5.77944 1.75 1.75 5.77944 1.75 10.75C1.75 15.7206 5.77944 19.75 10.75 19.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M17 17L22 22" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
</g>

@endPushOnce

<x-vui-icon-output
    :size="24"
    :name="$name"
    :aria-label="$ariaLabel ?? null"
    {{ $attributes }}
/>
