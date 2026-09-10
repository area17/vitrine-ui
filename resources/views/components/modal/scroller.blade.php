@props([
    'showClose' => true,
])

<div data-modal-scroller
     {{ $attributes->twMerge(VitrineUI::ui('modal-scroller')) }}>

    @if ($showClose)
        <div class="{{ VitrineUI::ui('modal-scroller', 'close-wrapper') }}">
            <div class="{{ VitrineUI::ui('modal-scroller', 'close-inner') }}">
                <x-vui-button class="{{ VitrineUI::ui('modal-scroller', 'close') }}"
                              data-modal-close-trigger
                              aria-label="{{ __('vitrine-ui::fe.close_modal') }}"
                              variant="secondary"
                              icon="close-24"
                              :icon-only="true" />
            </div>
        </div>
    @endif

    {!! $slot !!}
</div>
