@storybook([
    'name' => 'Background Video',
    'status' => 'readyForQA',
    'args' => [
        'backgroundVideo' => [
            'sources' => [
                [
                    'type' => 'video/mp4',
                    'src' => 'https://ia600106.us.archive.org/25/items/archive-video-files/test.mp4',
                ],
            ],
        ],
        'caption' => 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
    ],
])

<x-vui-media class="aspect-16/9"
             :background-video="$backgroundVideo ?? null"
             :caption="$caption ?? null" />
