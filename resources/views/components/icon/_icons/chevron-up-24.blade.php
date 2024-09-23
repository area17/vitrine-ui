@pushOnce('icon_sprite')
    <g id="{{ $name }}">
        <path d="M12.14 8.99994L18 15.2499L17.28 15.9399L12.14 10.4599L7 15.9399L6.28 15.2499L12.14 8.99994Z"
              fill="currentColor" />
    </g>
@endPushOnce

<x-vui-icon-output :size="24"
                   :name="$name"
                   :aria-label="$ariaLabel ?? null"
                   {{ $attributes }} />
