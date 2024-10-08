@pushOnce('icon_sprite')
    <g id="{{ $name }}">
        <path d="M14 7.5H2V8.5H14V7.5Z"
              fill="currentColor" />
    </g>
@endPushOnce

<x-vui-icon-output :size="16"
                   :name="$name"
                   :aria-label="$ariaLabel ?? null"
                   {{ $attributes }} />
