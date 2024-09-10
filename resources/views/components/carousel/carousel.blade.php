@php
    $sliderTag = $asList ? 'ul' : 'div';
    $sliderItemTag = $asList ? 'li' : 'div';
@endphp
<div>
</div>
<div data-behavior="Carousel"
     data-Carousel-configuration="{{ $configuration }}"
        {{ $attributes->twMerge([$ui('carousel', 'base')]) }}>
    <{{ $sliderTag }} class="{{ $ui('carousel', 'wrapper') }} swiper-wrapper ">
        @foreach ($items as $item)
            <{{ $sliderItemTag }} class="{{ $itemClass }} {{ $ui('carousel', 'item') }} swiper-slide">
            <x-dynamic-component :component="$component"
                                 :item="$item"/>
            </{{ $sliderItemTag }}>
        @endforeach
    </{{ $sliderTag }}>
    @if(!isset($pagination) || $pagination->isEmpty())
    <div class="{{ $ui('carousel', 'pagination') }}">
        <x-vui-button class="swiper-prev-btn {{ $ui('carousel', 'pagination-button') }}"
                      aria-label="{{ __('Previous slide') }}"
                      variant="{{ $paginationButtonVariant }}"
                      :icon-only="true"
                      icon="{{ $ui('carousel', 'pagination-icon-left') }}"/>
        <x-vui-button class="swiper-next-btn {{ $ui('carousel', 'pagination-button') }}"
                      aria-label="{{ __('Next slide') }}"
                      :icon-only="true"
                      variant="{{ $paginationButtonVariant }}"
                      icon="{{ $ui('carousel', 'pagination-icon-right') }}"/>
    </div>
    @else
        {{ $pagination }}
    @endif
    {{ $slot }}
</div>
