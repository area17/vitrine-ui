@pushOnce('icon_sprite')

    <g id="{{ $name }}">
        <path fill="currentColor" fill-rule="evenodd" d="M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-8 1V5H9v6h2Zm-1 4.25a1.25 1.25 0 1 0 0-2.5 1.25 1.25 0 0 0 0 2.5Z" clip-rule="evenodd"/>
    </g>

@endPushOnce

<x-vui-icon-output
        :size="20"
        :name="$name"
        :aria-label="$ariaLabel ?? null"
        {{ $attributes }}
/>
