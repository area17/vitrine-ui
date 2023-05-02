@storybook([
    'status' => 'readyForQA',
    'viewMode' => 'docs',
    'args' => [
        'label' => 'Lorem Ipsum',
        'href' => '#',
        'cancellable' => false
    ],
    'argTypes' => [
        'label' => [
            'description' => 'Plain text label used within the component slot. HTML will be escaped.',
            'defaultValue' => ['summary' => ''],
        ],
        'href' => [
            'description' => 'A url to the content item. Leaving this blank will not render a link within the item',
            'defaultValue' => ['summary' => false],
        ],
        'cancellable' => [
            'description' => 'Adds a close icon. Used for active filters',
            'defaultValue' => ['summary' => false],
        ]
    ]
])

<x-vui-tag
    :href="$href ?? null"
    :cancellable="$cancellable ?? null"
>
    {{ $label ?? null }}
</x-vui-tag>
