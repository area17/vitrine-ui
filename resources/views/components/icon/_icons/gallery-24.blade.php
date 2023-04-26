@pushOnce('icon_sprite')

<g id="{{ $name }}">
    <path d="M17.8008 17.75V6.25H6.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M21.3007 13.75V2.75H10.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M14.25 9.75H1.75V22.25H14.25V9.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</g>

@endPushOnce

@include('components.atoms.icon._output', ['size' => 24])
