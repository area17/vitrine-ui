@pushOnce('icon_sprite')
    <g id="{{ $name }}">
        <path d="M14 4L6 12L2 8"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="square"
              stroke-linejoin="round"></path>
    </g>
@endPushOnce

<x-vui-icon-output :size="16"
                   :name="$name"
                   :aria-label="$ariaLabel ?? null"
                   {{ $attributes }} />
