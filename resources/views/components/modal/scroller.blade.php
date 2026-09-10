@props([
    'showClose' => true,
])

<div data-Modal-scroller
     {{ $attributes->twMerge(VitrineUI::ui('modal-scroller')) }}>

    @if ($showClose)
        <x-vui-modal-close />
    @endif

    {!! $slot !!}
</div>
