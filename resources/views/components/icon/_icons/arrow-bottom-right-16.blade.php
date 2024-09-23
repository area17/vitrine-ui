@pushOnce('icon_sprite')
    <g id="{{ $name }}">
        <path d="M2 10H14M14 10L8.5 5M14 10L9 14.5"
              stroke="currentColor" />
        <path d="M2 10.5L2 1"
              stroke="currentColor" />
    </g>
@endPushOnce

<x-vui-icon-output :size="16"
                   :name="$name"
                   :aria-label="$ariaLabel ?? null"
                   {{ $attributes }} />
