@storybook([
    'args' => [
        'label' => 'Select an option',
        'headingLevel' => 3,
        'ariaLabel' => 'Select an option',
        'items' => [
            [
                'href' => '#',
                'text' => 'Link 1'
            ],
            [
                'href' => '#',
                'text' => 'Link 2'
            ],
            [
                'href' => '#',
                'text' => 'Link 3'
            ],
            [
                'href' => '#',
                'text' => 'Link 4'
            ],
        ]
    ],
    'argTypes' => [
        'headingLevel' => [
            'description' => 'The heading level for the dropdown list.',
            'defaultValue' => ['summary' => 3],
            'control' => 'number',
        ],
        'ariaLabel' => [
            'description' => 'ARIA label for accessibility, describing the purpose of the dropdown.',
            'defaultValue' => ['summary' => 'Select an option'],
            'control' => 'text',
        ],
        'label' => [
            'description' => 'Label text displayed on the dropdown button.',
            'defaultValue' => ['summary' => 'Options'],
            'control' => 'text',
        ],
    ]
])

<x-vui-dropdown
    :label="$label ?? null"
    :aria-label="$ariaLabel ?? null"
>
    @foreach ($items as $item)
        <li>
            <x-vui-link variant="secondary" :href="$item['href']">
                {{ $item['text'] }}
            </x-vui-link>
        </li>
    @endforeach
</x-vui-dropdown>
