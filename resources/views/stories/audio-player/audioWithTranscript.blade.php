@storybook([
    'name' => 'With Transcript',
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
        'transcript' => '<p>Lorem ipsum dolor sit amet scelerisque dapibus tincidunt. Sagittis hac iaculis adipiscing lacus aenean consequat arcu. Ullamcorper faucibus labore fringilla augue ornare dictum tempor congue et vivamus id. Proin purus sapien nullam justo convallis lacus diam senectus. Egestas phasellus tempus diam arcu dui id eget dictum porttitor feugiat facilisis hendrerit sed.</p>
        <p>Sed est augue nullam elit nec aliqua a nisl. Auctor iaculis consectetur et platea pellentesque incididunt duis suspendisse purus. Mattis quisque urna fusce curabitur magna fringilla lectus leo dolore integer nullam gravida facilisi. Cursus condimentum blandit quis aliqua vitae elementum neque. Incididunt lobortis tempus nunc et consectetur viverra in praesent eleifend fusce at interdum gravida.</p>',
    ],
])
<div class="w-full md:w-6-cols-vw">
    <x-vui-audio-player :download-url="$sources[0]['src'] ?? null"
                        :title="$title ?? null"
                        :subtitle="$subtitle ?? null"
                        :sources="$sources ?? null" />

    @if ($transcript)
        {{-- <x-molecules.accordion>
        <x-molecules.accordion.item
            title="Transcript"
            :index="0"
            :set-fixed-height="false"
        >
            <x-vui-wysiwyg>
                {!! $transcript !!}
            </x-vui-wysiwyg>
        </x-molecules.accordion.item>
    </x-molecules.accordion> --}}
    @endif
</div>
