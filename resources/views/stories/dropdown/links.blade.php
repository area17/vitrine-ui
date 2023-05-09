@storybook([
    'args' => [
        'label' => 'Select an option',
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
    ]
])

<x-vui-dropdown
    :label="$label ?? null"
>
    @foreach ($items as $item)
        <li>
            <x-vui-link-secondary :href="$item['href']">
                {{ $item['text'] }}
            </x-vui-link-secondary>
        </li>
    @endforeach
</x-vui-dropdown>
