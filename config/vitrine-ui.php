<?php

// config for A17/VitrineUI
return [
    'js_path' => resource_path('frontend/scripts/vendor'),

    'css_path' => resource_path('frontend/styles/vendor'),

    // The path of the published components. This is only used to generate the import paths in your published css and js files, it doesnt change the publish location. This can be replaced with an alias defined in your vite.config.json
    'published_views_path' => '../../../views/vendor/vitrine-ui/components',

    // the path to the components views within the vitrine-ui package. Used to generate the import paths in your published css and js files. This can be replaced with an alias defined in your vite.config.js
    'vendor_views_path' => '../../../../vendor/area17/vitrine-ui/resources/views/components',

    'components' => [
        'audio-player' => A17\VitrineUI\Components\AudioPlayer::class,
        'button' => A17\VitrineUI\Components\Button::class,
        'heading' => A17\VitrineUI\Components\Heading::class,
        'icon' => A17\VitrineUI\Components\Icon::class,
        'image-zoom' => A17\VitrineUI\Components\ImageZoom::class,
        'map-google' => A17\VitrineUI\Components\MapGoogle::class,
        'map-mapbox' => A17\VitrineUI\Components\MapMapBox::class,
        'media' => A17\VitrineUI\Components\Media::class,
        'modal' => A17\VitrineUI\Components\Modal::class,
        'tag' => A17\VitrineUI\Components\Tag::class,
        'video-background' => A17\VitrineUI\Components\VideoBackground::class,
        'wysiwyg' => A17\VitrineUI\Components\Wysiwyg::class,
    ]
];
