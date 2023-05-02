@storybook([
    'status' => 'readyForQA',
    'args' => [
        'image' => [
            '_static' => [
                'file' => '/static/work-oxman.jpg',
                'alt' => 'Dummy Alt Text'
            ],
        ],
        'video' => [
            'id' => 'CouF-tNHV3g',
            'type' => 'youtube',
            'autoplay' => true,
        ],
        'caption' => 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.'
    ],
    'argTypes' => [
        'image' => [
            'description' => 'Twill Image object or a `_static` image array containing a file path and alt text',
            'defaultValue' => ['summary' => ''],
        ],
        'video' => [
            'description' => 'An array containing the video `id` from the video URL, the `type` ( `youtube` or `vimeo` are the only providers supported at the moment), and a boolean for `autoplay`',
            'defaultValue' => ['summary' => ''],
        ],
        'caption' => [
            'description' => 'Plain text image caption. The component also supports the `mediaCaption` slot to allow you to pass html and attributes to the `figcaption` element.',
            'defaultValue' => ['summary' => ''],
        ],
    ]
])

<x-vui-media
    :image="$image ?? null"
    :video="$video ?? null"
    :caption="$caption ?? null"
/>
