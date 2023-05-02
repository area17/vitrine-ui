@storybook([
    'name' => 'Multiple Images',
    'layout' => 'fullscreen',
    'status' => 'readyForQA',
    'args' => [
        'sources' => [
            [
                'image' => [
                    '_static' => [
                        'file' => '/static/work-nike.jpg',
                        'alt' => 'Dummy Alt Text'
                    ],
                ],
            ],
            [
                'image' => [
                    '_static' => [
                        'file' => '/static/work-oxman.jpg',
                        'alt' => 'Dummy Alt Text'
                    ],
                ],
            ],
        ]
    ],
    'argTypes' => [
        'sources' => [
            'description' =>
                'Accepts an array of image data to render a static image or IIIF data to render an image from a IIIF image service. Passing multiple items enables paging.',
            'defaultValue' => ['summary' => false],
        ],
    ]
])

<x-vui-image-zoom
    :sources="$sources ?? null"
/>
