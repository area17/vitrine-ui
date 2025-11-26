@props([
    'id' => null,
    'showClose' => true,
    'closeButtonVariant' => null,
    'closeButtonSize' => null,
    'cookieTimeout' => 3, // Added cookieTimeout as a prop
])

@if (!$slot->isEmpty())
    <div data-banner-id="{{ $id }}"
         data-banner-cookietimeout="{{ $cookieTimeout }}"
         {{ $attributes->merge(['data-behavior' => $attributes->prepends('Banner')])->class(VitrineUI::ui('banner')) }}
         hidden>
        <div class="{{ VitrineUI::ui('banner', 'wrapper') }}">
            @if ($showClose)
                <x-vui-button class="{{ VitrineUI::ui('banner', 'close') }}"
                              data-banner-close-trigger
                              aria-label="{{ __('vitrine-ui::fe.close_banner') }}"
                              :icon-only="true"
                              variant="{{ $closeButtonVariant }}"
                              size="{{ $closeButtonSize }}"
                              icon="{{ VitrineUI::ui('banner', 'close-icon') }}"
                              icon-only />
            @endif

            {!! $slot !!}
        </div>
    </div>
@endif
