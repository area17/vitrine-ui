@storybook([
    'layout' => 'fullscreen',
    'args' => [
        'pages' => [
            1 => [
                'url' => '?page=1',
            ],
            2 => [],
            5 => [
                'url' => '?page=5',
            ],
            6 => [
                'url' => '?page=6',
            ],
            7 => [
                'url' => '?page=7',
            ],
            9 => [],
            10 => [
                'url' => '?page=10',
            ],
        ],
        'current_page' => 6,
        'last_page' => 10,
        'iconRight' => 'arrow-right-24',
        'iconLeft' => 'arrow-left-24',
        'btnVariant' => 'secondary',
        'btnSize' => 'sm',
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
        'btnVariant' => [
            'description' => 'The variant of the buttons used in pagination (previous/next).',
            'defaultValue' => ['summary' => 'secondary'],
            'control' => 'text',
        ],
        'btnSize' => [
            'description' => 'The variant size of the buttons used in pagination (previous/next).',
            'defaultValue' => ['summary' => 'sm'],
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
    ],
])

<div class="container">
    <x-vui-pagination-numbered :btn-variant="$btnVariant"
                               :pages="$pages ?? []"
                               :icon-left="$iconLeft"
                               :icon-right="$iconRight"
                               :current-page="$current_page"
                               :last-page="$last_page"
                               :btn-size="$btnSize" />
</div>
