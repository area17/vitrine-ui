@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M7.51465 7.51465L24.4852 24.4852" stroke="currentColor" stroke-width="1.25"/>
    <path d="M24.4854 7.51465L7.51479 24.4852" stroke="currentColor" stroke-width="1.25"/>
</g>

@endPushOnce

@include('components.atoms.icon._output', ['size' => 32])
