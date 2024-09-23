@storybook([
    'status' => 'readyForQA',
    'args' => [
        'level' => 1,
        'text' => 'Heading',
    ],
    'argTypes' => [
        'level' => [
            'control' => [
                'type' => 'number',
                'min' => 0,
                'max' => 6,
            ],
        ],
    ],
])

<x-vui-heading :level="$level">
    {{ $text }}
</x-vui-heading>
