@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M10 4H5H4V5V10H5V5H10V4Z" fill="currentColor"/>
    <path d="M14 4H19H20V5V10H19V5H14V4Z" fill="currentColor"/>
    <path d="M10 20H5H4V19V14H5V19H10V20Z" fill="currentColor"/>
    <path d="M14 20H19H20V19V14H19V19H14V20Z" fill="currentColor"/>
</g>

@endPushOnce

@include('components.atoms.icon._output', ['size' => 24])
