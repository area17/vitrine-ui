@storybook([
    'name' => 'Multiple Images',
    'layout' => 'fullscreen',
    'status' => 'readyForQA',
    'args' => [
        'sources' => [
            [
                'image' => [
                    'src' => 'https://placehold.co/600x400.png',
                    'alt' => 'Sample Alt Text',
                ],
            ],
            [
                'image' => [
                    'src' => 'https://placehold.co/800x800.png',
                    'alt' => 'Sample Alt Text',
                ],
            ],
        ],
    ],
    'argTypes' => [
        'sources' => [
            'description' => 'Accepts an array of image data to render a static image or IIIF data to render an image from a IIIF image service. Passing multiple items enables paging.',
            'defaultValue' => ['summary' => false],
        ],
    ],
])

<x-vui-image-zoom :sources="$sources ?? null" />
