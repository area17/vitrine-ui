@pushOnce('icon_sprite')
    <g id="{{ $name }}">
        <path d="M9.25966 7.66905L11.2926 5.63612C13.2452 3.6835 16.411 3.6835 18.3637 5.63612V5.63612C20.3163 7.58874 20.3163 10.7546 18.3637 12.7072L16.3307 14.7401M7.66867 9.26004L5.63574 11.293C3.68312 13.2456 3.68312 16.4114 5.63574 18.364V18.364C7.58836 20.3167 10.7542 20.3167 12.7068 18.364L14.7397 16.3311"
              stroke="currentColor" />
        <path d="M15.5352 8.46436L8.46409 15.5354"
              stroke="currentColor" />
    </g>
@endPushOnce

<x-vui-icon-output :size="24"
                   :name="$name"
                   :aria-label="$ariaLabel ?? null"
                   {{ $attributes }} />
