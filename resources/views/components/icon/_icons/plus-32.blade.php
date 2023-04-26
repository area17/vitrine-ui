@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M4 16H28M16 4V28" fill="none" stroke="currentColor" stroke-width="1.25"/>
</g>

@endPushOnce

@include('components.atoms.icon._output', ['size' => 32])
