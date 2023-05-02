@storybook([
    'status' => 'readyForQA',
    'args' => [
        'image' => [
            '_static' => [
                'file' => '/static/work-oxman.jpg',
                'alt' => 'Dummy Alt Text'
            ],
        ],
        'caption' => 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
        'cover' => false
    ],
    'argTypes' => [
        'image' => [
            'description' => 'Twill Image object or a `_static` image array containing a file path and alt text',
            'defaultValue' => ['summary' => ''],
        ],
        'caption' => [
            'description' => 'Plain text image caption. The component also supports the `mediaCaption` slot to allow you to pass html and attributes to the `figcaption` element.',
            'defaultValue' => ['summary' => ''],
        ],
        'cover' => [
            'description' => 'Set to `true` to enable `object-fit: cover`.',
            'defaultValue' => ['summary' => false],
        ],
    ]
])

<div class="{{ Arr::toCssClasses([
    'w-screen h-[50vh] -ml-[1rem]' => $cover
]) }}"
    style="min-width: 300px;"
>
    <x-vui-media
        :image="$image ?? null"
        :caption="$caption ?? null"
        :cover="$cover ?? null"
    />
</div>
