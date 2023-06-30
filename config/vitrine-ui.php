<?php

// config for A17/VitrineUI
return [
    'js_path' => resource_path('frontend/scripts/vendor'),

    'css_path' => resource_path('frontend/styles/vendor'),
    // The path of the published js assets. Used to generate the import paths in your published js files. This can be replaced with an alias defined in your vite.config.json
    // 'published_js_path' => './scripts/vendor/vitrine-ui',

    // // The path of the published css assets. Used to generate the import paths in your published css files. This can be replaced with an alias defined in your vite.config.json
    // 'published_css_path' => './css/vendor/vitrine-ui',

    // 'published_assets_path' => '../../../views/vendor/vitrine-ui/components',

    // the path to the components views within the vitrine-ui package. Used to generate the import paths in your published css and js files. This can be replaced with an alias defined in your vite.config.js
    'vendor_assets_path' => '../../../../vendor/area17/vitrine-ui/resources/frontend',

    'icons_view_path' => 'icon._icons',

    'vitrine_path' => resource_path('frontend/vitrine-ui'),

    'theme_file' => 'vitrine-ui.json',

    /* Used to publish stories */
    'stories_subfolder' => 'vitrine',

    // The prefix for the vitrine-ui components
    'prefix' => 'vui',

    // Required to define ide.json autocomplete rules
    'namespace' => '',

    'components' => [
        'accordion' => A17\VitrineUI\Components\Accordion::class,
        'audio-player' => A17\VitrineUI\Components\AudioPlayer::class,
        'breadcrumbs' => A17\VitrineUI\Components\Breadcrumbs::class,
        'button' => A17\VitrineUI\Components\Button::class,
        'card-inline' => A17\VitrineUI\Components\Card\Inline::class,
        'card-primary' => A17\VitrineUI\Components\Card\Primary::class,
        'datepicker' => A17\VitrineUI\Components\Datepicker::class,
        'dropdown' => A17\VitrineUI\Components\Dropdown::class,
        'form-checkbox' => A17\VitrineUI\Components\Form\Checkbox::class,
        'form-checkbox-group' => A17\VitrineUI\Components\Form\CheckboxGroup::class,
        'form-label' => A17\VitrineUI\Components\Form\Label::class,
        'form-date' => A17\VitrineUI\Components\Form\Date::class,
        'form-date-range' => A17\VitrineUI\Components\Form\DateRange::class,
        'form-date-trio' => A17\VitrineUI\Components\Form\DateTrio::class,
        'form-input' => A17\VitrineUI\Components\Form\Input::class,
        'form-password' => A17\VitrineUI\Components\Form\Password::class,
        'form-radio' => A17\VitrineUI\Components\Form\Radio::class,
        'form-radio-group' => A17\VitrineUI\Components\Form\RadioGroup::class,
        'form-range' => A17\VitrineUI\Components\Form\Range::class,
        'form-select' => A17\VitrineUI\Components\Form\Select::class,
        'form-textarea' => A17\VitrineUI\Components\Form\Textarea::class,
        'form-upload' => A17\VitrineUI\Components\Form\Upload::class,
        'heading' => A17\VitrineUI\Components\Heading::class,
        'icon' => A17\VitrineUI\Components\Icon::class,
        'image-zoom' => A17\VitrineUI\Components\ImageZoom::class,
        'listing' => A17\VitrineUI\Components\Listing::class,
        'link' => A17\VitrineUI\Components\Link::class,
        'map-google' => A17\VitrineUI\Components\MapGoogle::class,
        'map-mapbox' => A17\VitrineUI\Components\MapMapBox::class,
        'media' => A17\VitrineUI\Components\Media::class,
        'modal' => A17\VitrineUI\Components\Modal::class,
        'pagination' => A17\VitrineUI\Components\Pagination::class,
        'tag' => A17\VitrineUI\Components\Tag::class,
        'video-background' => A17\VitrineUI\Components\VideoBackground::class,
        'wysiwyg' => A17\VitrineUI\Components\Wysiwyg::class,
    ]
];
