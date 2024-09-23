<?php

$items = [
    [
        'image' => [
            'src' => 'https://placehold.co/600x400.png',
            'alt' => 'Sample Alt Text',
        ],
        'caption' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'credit' => 'Curabitur blandit tempus porttitor. Donec ullamcorper nulla non metus auctor fringilla.',
    ],
    [
        'image' => [
            'src' => 'https://placehold.co/600x400.png',
            'alt' => 'Sample Alt Text',
        ],
    ],
    [
        'image' => [
            'src' => 'https://placehold.co/600x400.png',
            'alt' => 'Sample Alt Text',
        ],
        'caption' => 'Integer posuere erat a ante venenatis dapibus posuere velit aliquet.',
        'credit' =>
            'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec id elit non mi porta gravida at eget metus.',
    ],
    [
        'image' => [
            'src' => 'https://placehold.co/600x400.png',
            'alt' => 'Sample Alt Text',
        ],
    ],
];

return [
    'full-bleed' => [
        'args' => [
            'media' => [
                'image' => [
                    'src' => 'https://placehold.co/600x400.png',
                    'alt' => 'Sample Alt Text',
                ],
                'caption' =>
                    'Proin id aliquet in praesent sit laoreet mauris dignissim id rhoncus fames vel ut feugiata.',
                'credit' => 'Photo credit',
            ],
            'items' => $items,
        ],
    ],
    'grid' => [
        'args' => [
            'items' => $items,
        ],
    ],
];
