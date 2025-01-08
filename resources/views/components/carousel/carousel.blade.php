@php
    $sliderTag = $asList ? 'ul' : 'div';
    $sliderItemTag = $asList ? 'li' : 'div';
@endphp

<div data-behavior="Carousel"
     data-Carousel-configuration="{{ $configuration }}"
     {{ $attributes->twMerge([$ui('carousel', 'base')]) }}>
    <{{ $sliderTag }} class="{{ $ui('carousel', 'wrapper') }} {{ $swiperWrapperClass ?? '' }} swiper-wrapper">
        @foreach ($items as $item)
            <{{ $sliderItemTag }} class="{{ $itemClass }} {{ $ui('carousel', 'item') }} swiper-slide">
                <x-dynamic-component :component="$component"
                                     :item="$item" />
                </{{ $sliderItemTag }}>
        @endforeach
        </{{ $sliderTag }}>
        @if ($withControls || $withPagination || $slot->isNotEmpty())
            <div class="{{ $ui('carousel', 'footer') }}">
                @if ($withControls)
                    @if (!isset($controls) || $controls->isEmpty())
                        <div class="{{ $ui('carousel', 'controls') }}">
                            <x-vui-button class="swiper-prev-btn {{ $ui('carousel', 'controls-button') }}"
                                          aria-label="{{ __('Previous slide') }}"
                                          variant="{{ $controlsButtonVariant }}"
                                          :icon-only="true"
                                          icon="{{ $ui('carousel', 'controls-icon-left') }}" />
                            <x-vui-button class="swiper-next-btn {{ $ui('carousel', 'controls-button') }}"
                                          aria-label="{{ __('Next slide') }}"
                                          :icon-only="true"
                                          variant="{{ $controlsButtonVariant }}"
                                          icon="{{ $ui('carousel', 'controls-icon-right') }}" />
                        </div>
                    @else
                        {{ $controls }}
                    @endif
                @endif
                @if ($withPagination)
                    @if (!isset($pagination) || $pagination->isEmpty())
                        <div class="swiper-pagination {{ $ui('carousel', 'pagination') }}"></div>
                    @else
                        {{ $pagination }}
                    @endif
                @endif
                {{ $slot }}
            </div>
        @endif
</div>
