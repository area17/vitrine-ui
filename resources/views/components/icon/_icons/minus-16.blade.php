@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M14 7.5H2V8.5H14V7.5Z" fill="currentColor"/>
</g>

@endPushOnce

@include('components.atoms.icon._output', ['size' => 16])
