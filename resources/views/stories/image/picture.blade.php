@storybook([
    'name' => 'Picture',
    'status' => 'readyForQA',
    'args' => [
        'image' => [
            'src' => 'https://placehold.co/400x400.png',
            'alt' => 'Sample Alt Text',
            'sources' => [
                [
                    'media' => '(min-width: 1024px)',
                    'srcSet' => 'https://placehold.co/600x400.png, https://placehold.co/1200x800.png 2x',
                ],
                [
                    'media' => '(min-width: 768px)',
                    'srcSet' => 'https://placehold.co/400x600.png, https://placehold.co/800x1200.png 2x',
                ],
            ],
        ],
        'loading' => 'lazy',
    ],
    'argTypes' => [
        'loading' => [
            'description' => 'Loading attribute for the image',
            'defaultValue' => ['summary' => 'lazy'],
        ],
    ],
])
<x-vui-image :image="$image"
             :loading="$loading" />
