@pushOnce('icon_sprite')
    <g id="{{ $name }}">
        <path d="M18.02 6.71L17.31 6L12.01 11.3L6.71 6L6 6.71L11.3 12.01L6 17.31L6.71 18.02L12.01 12.72L17.31 18.02L18.02 17.31L12.72 12.01L18.02 6.71Z"
              fill="currentColor" />
    </g>
@endPushOnce

<x-vui-icon-output :size="24"
                   :name="$name"
                   :aria-label="$ariaLabel ?? null"
                   {{ $attributes }} />
