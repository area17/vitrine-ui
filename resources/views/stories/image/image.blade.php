@storybook([
    'name' => 'Image',
    'status' => 'readyForQA',
    'args' => [
        'image' => [
            'src' => 'https://placehold.co/600x400.png',
            'alt' => 'Sample Alt Text',
        ],
        'loading' => 'lazy',
    ],
    'argTypes' => [
        'image' => [
            'description' => 'Twill Image object or a `_static` image array containing a file path and alt text',
            'defaultValue' => ['summary' => ''],
        ],
        'loading' => [
            'description' => 'Loading attribute for the image',
            'defaultValue' => ['summary' => 'lazy'],
        ],
    ],
])
<x-vui-image :image="$image"
             :loading="$loading" />
