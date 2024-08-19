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
        ],
        'tag' => 'nav'
    ],
    'argTypes' => [
        'items' => [
        'description' => 'An array of breadcrumb items. Each item is an associative array that can have the following keys:
            <ul>
                <li> href or url : The URL for the breadcrumb link. If this key is not present, the item will be rendered as plain text</li>.
                <li> text or label : The text displayed for the breadcrumb item.</li>
            </ul>',
            'defaultValue' => ['summary' => []],
            'control' => 'object',
        ],
        'tag' => [
            'description' => 'The HTML tag used to wrap the breadcrumb navigation.',
            'defaultValue' => ['summary' => 'nav'],
            'control' => 'object',
        ]
    ]
])

<x-vui-breadcrumbs
    :tag="$tag"
    :items="$items ?? false"
/>
