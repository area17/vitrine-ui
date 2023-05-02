<?php

$items = [
    [
        'image' => [
            '_static' => [
                'file' => '/static/work-oxman.jpg',
                'alt' => 'Dummy Alt Text',
            ],
        ],
        'caption' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'credit' => 'Curabitur blandit tempus porttitor. Donec ullamcorper nulla non metus auctor fringilla.',
    ],
    [
        'image' => [
            '_static' => [
                'file' => '/static/work-nike.jpg',
                'alt' => 'Dummy Alt Text',
            ],
        ],
    ],
    [
        'image' => [
            '_static' => [
                'file' => '/static/work-motf.jpg',
                'alt' => 'Dummy Alt Text',
            ],
        ],
        'caption' => 'Integer posuere erat a ante venenatis dapibus posuere velit aliquet.',
        'credit' =>
            'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec id elit non mi porta gravida at eget metus.',
    ],
    [
        'image' => [
            '_static' => [
                'file' => '/static/work-flv.jpg',
                'alt' => 'Dummy Alt Text',
            ],
        ],
    ],
];

return [
    'full-bleed' => [
        'args' => [
            'media' => [
                'image' => [
                    '_static' => [
                        'file' => '/static/work-oxman.jpg',
                        'alt' => 'Dummy Alt Text',
                    ],
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
