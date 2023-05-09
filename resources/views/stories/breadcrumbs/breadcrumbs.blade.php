@storybook([
    'status' => 'readyForQA',
    'args' => [
        'items' => [
            [
                'href' => '#',
                'text' => 'Bread',
            ],
            [
                'href' => false,
                'text' => 'Crumbs',
            ],
        ]
    ]
])

<x-vui-breadcrumbs
    :items="$items ?? false"
/>
