@storybook([
    'layout' => 'fullscreen',
    'args' => [
        'pages' => [
            [
                'url' => '?page=1',
            ],
            [
                'url' => '?page=2',
            ],
            [
                'url' => '?page=3',
            ],
        ],
        'current_page' => 1,
        'last_page' => 3,
        'current_page_count' => 10,
        'total' => 25,
        'labelInsideDropdown' => false,
        'iconRight' => 'arrow-right-24',
        'iconLeft' => 'arrow-left-24',
        'btnVariant' => 'secondary'
    ],
    'argTypes' => [
        'pages' => [
            'description' => 'An array of pages, each containing a URL.',
            'defaultValue' => ['summary' => []],
            'control' => 'object',
        ],
        'current_page' => [
            'description' => 'The current page number.',
            'defaultValue' => ['summary' => 1],
            'control' => 'number',
        ],
        'last_page' => [
            'description' => 'The last page number.',
            'defaultValue' => ['summary' => 1],
            'control' => 'number',
        ],
        'current_page_count' => [
            'description' => 'The number of items displayed on the current page.',
            'defaultValue' => ['summary' => 10],
            'control' => 'number',
        ],
        'total' => [
            'description' => 'The total number of items.',
            'defaultValue' => ['summary' => 25],
            'control' => 'number',
        ],
        'btnVariant' => [
            'description' => 'The variant of the buttons used in pagination (previous/next).',
            'defaultValue' => ['summary' => 'secondary'],
            'control' => 'text',
        ],
        'iconLeft' => [
            'description' => 'The icon used for the previous button.',
            'defaultValue' => ['summary' => 'arrow-left-24'],
            'control' => 'text',
        ],
        'iconRight' => [
            'description' => 'The icon used for the next button.',
            'defaultValue' => ['summary' => 'arrow-right-24'],
            'control' => 'text',
        ],
        'labelInsideDropdown' => [
            'description' => 'Boolean to display label inside the dropdown. If set to false will display only the page number',
            'defaultValue' => ['summary' => true],
            'control' => 'boolean',
        ],
    ]
])

<x-helpers.story-decorator>
    <x-vui-pagination :btnVariant="$btnVariant" :pages="$pages ?? []" :iconLeft="$iconLeft" :iconRight="$iconRight" :currentPage="$current_page" :currentPageCount="$current_page_count" :lastPage="$last_page" :total="$total"
        btnVariant="secondary-icon" />
</x-helpers.story-decorator>
