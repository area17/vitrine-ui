@storybook([
    'status' => 'readyForQA',
    'args' => [
        'title' => 'Lorem Ipsum',
        'subtitle' => 'Dolor sit amet',
        'sources' => [
            [
                'src' => 'https://filesamples.com/samples/audio/mp3/sample4.mp3',
                'type' => 'audio/mpeg',
            ],
        ],
    ],
])

<div class="w-full md:w-6-cols-vw">
    <x-vui-audio-player class="mt-40"
                        :download-url="$sources[0]['src'] ?? null"
                        :title="$title ?? null"
                        :subtitle="$subtitle ?? null"
                        :sources="$sources ?? null" />
</div>
