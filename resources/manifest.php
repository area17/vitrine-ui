<?php

use A17\VitrineUI\Components;

/*
 * Everything the package knows about each component alias, used by `vitrine-ui:publish` and the tests.
 * Not published: it describes the package's own files.
 *
 * class   : the package class (null for Blade-only components). The class actually used by an app is set in config `components`.
 * view    : folder in resources/views/components
 * stories : folder in resources/views/stories (null when there are no stories)
 * assets  : js / css (relative to resources/frontend/scripts and /css), npm packages,
 *           and `optional` groups only needed for a given feature
 */
return [
    'accordion' => [
        'class' => Components\Accordion::class,
        'view' => 'accordion',
        'stories' => 'accordion',
        'assets' => [
            'js' => ['behaviors/Accordion.js'],
        ],
    ],
    'audio-player' => [
        'class' => Components\AudioPlayer::class,
        'view' => 'audio-player',
        'stories' => 'audio-player',
        'assets' => [
            'js' => ['behaviors/AudioPlayer.js'],
            'css' => ['components/audio-player.css'],
        ],
    ],
    'breadcrumbs' => [
        'class' => Components\Breadcrumbs::class,
        'view' => 'breadcrumbs',
        'stories' => 'breadcrumbs',
        'assets' => [],
    ],
    'button' => [
        'class' => Components\Button::class,
        'view' => 'button',
        'stories' => 'button',
        'assets' => [],
    ],
    'card' => [
        'class' => Components\Card::class,
        'view' => 'card',
        'stories' => null,
        'assets' => [],
    ],
    'card-link' => [
        'class' => Components\CardLink::class,
        'view' => 'card',
        'stories' => null,
        'assets' => [],
    ],
    'carousel' => [
        'class' => Components\Carousel::class,
        'view' => 'carousel',
        'stories' => 'carousel',
        'assets' => [
            'npm' => ['swiper'],
            'js' => ['behaviors/Carousel.js'],
        ],
    ],
    'datepicker' => [
        'class' => Components\Datepicker::class,
        'view' => 'datepicker',
        'stories' => 'datepicker',
        'assets' => [
            'npm' => ['wc-datepicker', 'focus-trap'],
            'js' => ['behaviors/Datepicker.js'],
            'css' => ['components/datepicker.css'],
        ],
    ],
    'dropdown' => [
        'class' => Components\Dropdown::class,
        'view' => 'dropdown',
        'stories' => 'dropdown',
        'assets' => [
            'npm' => ['@area17/a17-helpers'],
            'js' => ['behaviors/Dropdown.js'],
        ],
    ],
    'form-checkbox' => [
        'class' => Components\Form\Checkbox::class,
        'view' => 'form/checkbox',
        'stories' => 'form/checkbox',
        'assets' => [
            'js' => ['behaviors/Input.js'],
        ],
    ],
    'form-checkbox-group' => [
        'class' => Components\Form\CheckboxGroup::class,
        'view' => 'form/checkbox-group',
        'stories' => 'form/checkbox-group',
        'assets' => [],
    ],
    'form-label' => [
        'class' => Components\Form\Label::class,
        'view' => 'form/label',
        'stories' => 'form/label',
        'assets' => [],
    ],
    'form-date' => [
        'class' => Components\Form\Date::class,
        'view' => 'form/date',
        'stories' => 'form/date',
        'assets' => [
            'npm' => ['@area17/parse-numeric-date'],
            'js' => [
                'utils/formatDate.js',
                'behaviors/Input.js',
                'behaviors/DateInput.js',
                'behaviors/DateInputFuzzy.js',
            ],
        ],
    ],
    'form-date-range' => [
        'class' => Components\Form\DateRange::class,
        'view' => 'form/date-range',
        'stories' => 'form/date-range',
        'assets' => [
            'js' => ['utils/formatDate.js', 'behaviors/DateRange.js'],
        ],
    ],
    'form-date-trio' => [
        'class' => Components\Form\DateTrio::class,
        'view' => 'form/date-trio',
        'stories' => 'form/date-trio',
        'assets' => [
            'js' => ['behaviors/DateTrio.js'],
        ],
    ],
    'form-field' => [
        'class' => Components\Form\Field::class,
        'view' => 'form/field',
        'stories' => 'form/field',
        'assets' => [
            'js' => ['behaviors/Input.js'],
        ],
    ],
    'form-input' => [
        'class' => Components\Form\Input::class,
        'view' => 'form/input',
        'stories' => null,
        'assets' => [
            'js' => ['behaviors/Input.js'],
        ],
    ],
    'form-password' => [
        'class' => Components\Form\Password::class,
        'view' => 'form/password',
        'stories' => 'form/password',
        'assets' => [
            'js' => ['behaviors/PasswordInput.js', 'behaviors/Input.js'],
        ],
    ],
    'form-radio' => [
        'class' => Components\Form\Radio::class,
        'view' => 'form/radio',
        'stories' => 'form/radio',
        'assets' => [
            'js' => ['behaviors/Input.js'],
        ],
    ],
    'form-radio-group' => [
        'class' => Components\Form\RadioGroup::class,
        'view' => 'form/radio-group',
        'stories' => 'form/radio-group',
        'assets' => [
            'js' => ['behaviors/RadioGroup.js'],
        ],
    ],
    'form-range' => [
        'class' => Components\Form\Range::class,
        'view' => 'form/range',
        'stories' => 'form/range',
        'assets' => [
            'npm' => ['range-slider-input'],
            'js' => ['behaviors/RangeInput.js'],
            'css' => ['components/form/range.css'],
        ],
    ],
    'form-select' => [
        'class' => Components\Form\Select::class,
        'view' => 'form/select',
        'stories' => 'form/select',
        'assets' => [
            'js' => ['behaviors/Input.js', 'behaviors/SelectSizer.js'],
        ],
    ],
    'form-textarea' => [
        'class' => Components\Form\Textarea::class,
        'view' => 'form/textarea',
        'stories' => 'form/textarea',
        'assets' => [
            'js' => ['behaviors/Input.js'],
        ],
    ],
    'form-upload' => [
        'class' => Components\Form\Upload::class,
        'view' => 'form/upload',
        'stories' => 'form/upload',
        'assets' => [
            'js' => ['behaviors/FileUpload.js', 'behaviors/Input.js'],
            'css' => ['components/form/upload.css'],
        ],
    ],
    'heading' => [
        'class' => Components\Heading::class,
        'view' => 'heading',
        'stories' => 'heading',
        'assets' => [],
    ],
    'icon' => [
        'class' => Components\Icon::class,
        'view' => 'icon',
        'stories' => 'icon',
        'assets' => [],
    ],
    'image' => [
        'class' => Components\Image::class,
        'view' => 'image',
        'stories' => 'image',
        'assets' => [],
    ],
    'image-zoom' => [
        'class' => Components\ImageZoom::class,
        'view' => 'image-zoom',
        'stories' => 'image-zoom',
        'assets' => [
            'npm' => ['openseadragon'],
            'js' => ['behaviors/ImageZoom.js'],
        ],
    ],
    'link' => [
        'class' => Components\Link::class,
        'view' => 'button',
        'stories' => 'link',
        'assets' => [],
    ],
    'map-google' => [
        'class' => Components\MapGoogle::class,
        'view' => 'map-google',
        'stories' => 'map-google',
        'assets' => [
            'npm' => ['@googlemaps/js-api-loader'],
            'js' => ['behaviors/GoogleMaps.js'],
        ],
    ],
    'map-mapbox' => [
        'class' => Components\MapMapbox::class,
        'view' => 'map-mapbox',
        'stories' => 'map-mapbox',
        'assets' => [
            'npm' => ['mapbox-gl'],
            'js' => ['behaviors/MapBoxMaps.js'],
            'css' => ['components/map-mapbox.css'],
        ],
    ],
    'media' => [
        'class' => Components\Media::class,
        'view' => 'media',
        'stories' => 'media',
        'assets' => [
            'npm' => ['@area17/a17-helpers'],
            'js' => ['behaviors/ShowVideo.js'],
        ],
    ],
    'modal' => [
        'class' => Components\Modal::class,
        'view' => 'modal',
        'stories' => 'modal',
        'assets' => [
            'npm' => ['body-scroll-lock-upgrade', 'focus-trap'],
            'js' => ['behaviors/Modal.js'],
        ],
    ],
    'pagination' => [
        'class' => Components\Pagination::class,
        'view' => 'pagination',
        'stories' => 'pagination',
        'assets' => [
            'js' => ['behaviors/Pagination.js'],
        ],
    ],
    'tabs' => [
        'class' => Components\Tabs::class,
        'view' => 'tabs',
        'stories' => 'tabs',
        'assets' => [
            'js' => ['behaviors/Tabs.js'],
        ],
    ],
    'tabs-list' => [
        'class' => Components\TabList::class,
        'view' => 'tabs',
        'stories' => 'tabs',
        'assets' => [],
    ],
    'tabs-panel' => [
        'class' => Components\TabPanel::class,
        'view' => 'tabs',
        'stories' => 'tabs',
        'assets' => [],
    ],
    'tag' => [
        'class' => Components\Tag::class,
        'view' => 'tag',
        'stories' => 'tag',
        'assets' => [],
    ],
    'video-background' => [
        'class' => Components\VideoBackground::class,
        'view' => 'video-background',
        'stories' => null,
        'assets' => [
            'js' => ['behaviors/VideoBackground.js'],
            'optional' => [
                'video.js' => ['npm' => ['video.js'], 'js' => ['behaviors/VideoBackgroundVideoJs.js']],
            ],
        ],
    ],
    'wysiwyg' => [
        'class' => Components\Wysiwyg::class,
        'view' => 'wysiwyg',
        'stories' => 'wysiwyg',
        'assets' => [
            'css' => ['components/wysiwyg.css'],
        ],
    ],
    'accordion-item' => [
        'class' => null,
        'view' => 'accordion',
        'stories' => 'accordion',
        'assets' => [],
    ],
    'filters-panel' => [
        'class' => null,
        'view' => 'filters',
        'stories' => 'filters',
        'assets' => [
            'js' => ['behaviors/FilterPanel.js'],
        ],
    ],
    'banner' => [
        'class' => null,
        'view' => 'banner',
        'stories' => 'banner',
        'assets' => [
            'npm' => ['@area17/a17-helpers'],
            'js' => ['behaviors/Banner.js'],
        ],
    ],
    'img' => [
        'class' => null,
        'view' => 'media',
        'stories' => 'media',
        'assets' => [],
    ],
    'icon-output' => [
        'class' => null,
        'view' => 'icon',
        'stories' => 'icon',
        'assets' => [],
    ],
    'icon-sprite' => [
        'class' => null,
        'view' => 'icon',
        'stories' => 'icon',
        'assets' => [],
    ],
    'modal-close' => [
        'class' => null,
        'view' => 'modal',
        'stories' => 'modal',
        'assets' => [],
    ],
    'modal-scroller' => [
        'class' => null,
        'view' => 'modal',
        'stories' => 'modal',
        'assets' => [],
    ],
    'pagination-numbered' => [
        'class' => null,
        'view' => 'pagination-numbered',
        'stories' => 'pagination-numbered',
        'assets' => [],
    ],
    'picture' => [
        'class' => null,
        'view' => 'media',
        'stories' => 'media',
        'assets' => [],
    ],
];
