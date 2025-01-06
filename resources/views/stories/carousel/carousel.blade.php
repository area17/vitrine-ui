@storybook([
    'status' => 'readyForQA',
    'args' => [
        'items' => [
            [
                'title' => 'Slide 1',
            ],
            [
                'title' => 'Slide 2',
            ],
            [
                'title' => 'Slide 3',
            ],
            [
                'title' => 'Slide 4',
            ],
            [
                'title' => 'Slide 5',
            ],
            [
                'title' => 'Slide 6',
            ],
            [
                'title' => 'Slide 7',
            ],
            [
                'title' => 'Slide 8',
            ],
        ],
    ],
])

@php
    $MEDIA_CAROUSEL = [
        'slidesPerView' => 'auto',
        'freeMode' => false,
        'allowTouchMove' => true,
        'loop' => false,
        'spaceBetween' => 10,
    ];
@endphp

<script>
    window.A17 = window.A17 || {};
    window.A17.sliderConfigurations = {
        'media-carousel': {
            ...@json($MEDIA_CAROUSEL)
        }
    };
</script>

<x-vui-carousel @class(['h-[320px] px-outer-gutter'])
                :items="$items"
                item-class="w-1/4 flex"
                component="demo-carousel-item"
                configuration="media-carousel"
                :with-controls="false" />
