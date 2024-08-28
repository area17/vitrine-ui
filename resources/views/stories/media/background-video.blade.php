@storybook([
    'name' => 'Background Video',
    'status' => 'readyForQA',
    'args' => [
        'backgroundVideo' => [
            'sources' => [
                [
                    "type" => "video/mp4",
                    "src" => "/static/demo-video.mp4"
                ]
            ],
        ],
        'caption' => 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.'
    ]
])

<x-vui-media
    :background-video="$backgroundVideo ?? null"
    :caption="$caption ?? null"
/>
