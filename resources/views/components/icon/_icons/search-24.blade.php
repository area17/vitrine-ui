@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <circle cx="10.5" cy="10.5" r="6" stroke="currentColor"/>
    <path d="M15 15L19 19" stroke="currentColor"/>
</g>

@endPushOnce

@include('components.atoms.icon._output', ['size' => 24])
