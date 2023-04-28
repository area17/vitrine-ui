@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M3 7.99977V15.9998H7.83L12 20.2398V3.75977L7.83 7.99977H3ZM11 6.24977V17.7498L8.32 14.9998H4V8.99977H8.32L11 6.24977Z" fill="currentColor"/>
    <path d="M19 12C19 10.6739 18.4732 9.40215 17.5355 8.46447C16.5979 7.52678 15.3261 7 14 7V8.11C15.0317 8.11 16.0211 8.51984 16.7506 9.24935C17.4802 9.97887 17.89 10.9683 17.89 12C17.89 13.0317 17.4802 14.0211 16.7506 14.7506C16.0211 15.4802 15.0317 15.89 14 15.89V17C15.3261 17 16.5979 16.4732 17.5355 15.5355C18.4732 14.5979 19 13.3261 19 12Z" fill="currentColor"/>
    <path d="M14 4.77979V5.88978C15.6205 5.88978 17.1746 6.53352 18.3204 7.67936C19.4663 8.82521 20.11 10.3793 20.11 11.9998C20.11 13.6203 19.4663 15.1744 18.3204 16.3202C17.1746 17.4661 15.6205 18.1098 14 18.1098V19.2198C15.9149 19.2198 17.7513 18.4591 19.1053 17.1051C20.4593 15.7511 21.22 13.9146 21.22 11.9998C21.22 10.0849 20.4593 8.24849 19.1053 6.89447C17.7513 5.54046 15.9149 4.77979 14 4.77979Z" fill="currentColor"/>
</g>

@endPushOnce

<x-vui-icon-output
    :size="24"
    :name="$name"
    :aria-label="$ariaLabel ?? null"
/>
