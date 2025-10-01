@storybook([
    'name' => 'Image Static',
    'status' => 'readyForQA',
    'args' => [
        'src' => 'https://placehold.co/600x400.png',
        'alt' => 'Sample Alt Text Static',
        'width' => 600,
        'height' => 400,
        'loading' => 'lazy',
    ],
    'argTypes' => [
        'loading' => [
            'description' => 'Loading attribute for the image',
            'defaultValue' => ['summary' => 'lazy'],
        ],
    ],
])
<x-vui-image :src="$src"
             :alt="$alt"
             :width="$width"
             :height="$height"
             :loading="$loading" />
