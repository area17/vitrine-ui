@pushOnce('icon_sprite')
    <g id="{{ $name }}">
        <path d="M12.5962 11.889L8.70711 7.99993L12.5962 4.11084L11.8891 3.40374L8 7.29282L4.11091 3.40374L3.40381 4.11084L7.29289 7.99993L3.40381 11.889L4.11091 12.5961L8 8.70704L11.8891 12.5961L12.5962 11.889Z"
              fill="currentColor" />
    </g>
@endPushOnce

<x-vui-icon-output :size="16"
                   :name="$name"
                   :aria-label="$ariaLabel ?? null"
                   {{ $attributes }} />
