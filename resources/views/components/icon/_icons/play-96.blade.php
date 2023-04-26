@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M69 48L35 28L35 68L69 48Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"/>
</g>

@endPushOnce

@include('components.atoms.icon._output', ['size' => 96])
