<?php

return [
    'primary' => [
        'args' => [
            'headingLevel' => 3,
            'href' => '#',
            'title' => 'Title',
            'description' => 'Description',
            'media' => [
                'image' => [
                    '_static' => [
                        'file' => '/static/work-nike.jpg',
                        'alt' => 'Dummy Alt Text',
                    ],
                ],
            ],
        ],
        'argTypes' => [
            'headingLevel' => [
                'description' =>
                    'Sets the `h` element\'s level for the component title. Controls the heading hierarchy level and has no visual effect.',
                'defaultValue' => ['summary' => '3'],
            ],
            'href' => [
                'description' => 'A url to the content item. Leaving this blank will not render a link within the item',
                'defaultValue' => ['summary' => ''],
            ],
            'title' => [
                'description' => 'Plain text used for the item\'s title',
                'defaultValue' => ['summary' => ''],
            ],
            'description' => [
                'description' => 'Plain text used for the text beneath the title',
                'defaultValue' => ['summary' => ''],
            ],
            'media' => [
                'description' => 'An array containing a Twill Image array.',
                'defaultValue' => ['summary' => ''],
            ],
        ],
    ],
    'inline' => [
        'args' => [
            'headingLevel' => 3,
            'href' => '#',
            'title' => 'Cras mattis consectetur purus sit amet fermentum.',
            'description' =>
                'Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Maecenas sed diam eget risus varius blandit sit amet non magna.',
            'date' => '01 January, 2023',
            'media' => [
                'image' => [
                    '_static' => [
                        'file' => '/static/work-nike.jpg',
                        'alt' => 'Dummy Alt Text',
                    ],
                ],
            ],
        ],
        'argTypes' => [
            'headingLevel' => [
                'description' =>
                    'Sets the `h` element\'s level for the component title. Controls the heading hierarchy level and has no visual effect.',
                'defaultValue' => ['summary' => '3'],
            ],
            'href' => [
                'description' => 'A url to the content item. Leaving this blank will not render a link within the item',
                'defaultValue' => ['summary' => ''],
            ],
            'title' => [
                'description' => 'Plain text used for the item\'s title',
                'defaultValue' => ['summary' => ''],
            ],
            'description' => [
                'description' => 'Plain text used for the text beneath the title',
                'defaultValue' => ['summary' => ''],
            ],
            'date' => [
                'description' => 'Plain text used for the date text beneath the description',
                'defaultValue' => ['summary' => ''],
            ],
            'media' => [
                'description' => 'An array containing a Twill Image array.',
                'defaultValue' => ['summary' => ''],
            ],
        ],
    ],
];
