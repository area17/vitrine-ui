@storybook([
    'status' => 'readyForQA',
    'args' => [
        'items' => [
            [
                'src' => 'https://placehold.co/600x400.png',
                'alt' => 'Sample Alt Text',
            ],
            [
                'src' => 'https://placehold.co/600x400.png',
                'alt' => 'Sample Alt Text',
            ],
            [
                'src' => 'https://placehold.co/600x400.png',
                'alt' => 'Sample Alt Text',
            ],
            [
                'src' => 'https://placehold.co/600x400.png',
                'alt' => 'Sample Alt Text',
            ],
            [
                'src' => 'https://placehold.co/600x400.png',
                'alt' => 'Sample Alt Text',
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
                component="x-vui-image"
                configuration="media-carousel"
                :with-controls="false"
                item-class="flex" />
