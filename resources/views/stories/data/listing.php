<?php

return [
    'base' => [
        'presetArgs' => [
            'items' => ['card.primary', 'card.primary', 'card.primary', 'card.primary', 'card.primary', 'card.primary'],
        ],
        'args' => [
            'layout' => '1up',
        ],
        'argTypes' => [
            'layout' => [
                'control' => 'select',
                'options' => ['1up', '2up', '2up-left', '2up-right', '3up', '3up-portrait', '4up', '6up'],
                'description' => 'The column layout of the listing component',
                'defaultValue' => ['summary' => '1up'],
            ],
        ],
    ],
    'inline' => [
        'presetArgs' => [
            'items' => ['card.inline', 'card.inline', 'card.inline', 'card.inline', 'card.inline', 'card.inline'],
        ],
    ],

    'masonry' => [
        'presetArgs' => [
            'items' => ['card.primary', 'card.primary', 'card.primary', 'card.primary', 'card.primary'],
        ],
    ],
];
