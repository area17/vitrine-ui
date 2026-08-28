@storybook([
    'name' => 'Panel',
    'layout' => 'fullscreen',
    'args' => [
        'title' => 'Filter',
        'filters' => [
            [
                'title' => 'Category',
                'name' => 'type',
                'type' => 'checkbox',
                'open' => true,
                'items' => [
                    [
                        'label' => 'Checkbox',
                        'value' => 'checkbox1',
                    ],
                    [
                        'label' => 'Checkbox',
                        'value' => 'checkbox2',
                    ],
                    [
                        'label' => 'Checkbox',
                        'value' => 'checkbox3',
                    ],
                    [
                        'label' => 'Checkbox',
                        'value' => 'checkbox4',
                    ],
                ],
            ],
            [
                'title' => 'Topic',
                'name' => 'topic',
                'type' => 'checkbox',
                'open' => false,
                'items' => [
                    [
                        'label' => 'Checkbox',
                        'value' => 'checkbox5',
                    ],
                    [
                        'label' => 'Checkbox',
                        'value' => 'checkbox6',
                    ],
                ],
            ],
            [
                'title' => 'Sort by',
                'name' => 'sort',
                'type' => 'radio',
                'open' => false,
                'omitFromChips' => true,
                'items' => [
                    [
                        'label' => 'Newest to oldest',
                        'value' => 'newest',
                    ],
                    [
                        'label' => 'Oldest to newest',
                        'value' => 'oldest',
                    ],
                ],
            ],
        ],
    ],
    'argTypes' => [
        'title' => [
            'control' => 'text',
            'description' => 'Title for the filter panel',
        ],
        'filters' => [
            'control' => 'object',
            'description' => 'Array of filter objects to render in an accordion',
        ],
        'showChips' => [
            'control' => 'boolean',
            'description' => 'Controls whether to show the chips section',
            'defaultValue' => ['summary' => true],
        ],
        'open' => [
            'control' => 'boolean',
            'description' => 'Controls the open state of the panel',
            'defaultValue' => ['summary' => false],
        ],
        'behavior' => [
            'control' => 'text',
            'description' => 'Name of javascript behavior to use',
            'defaultValue' => ['summary' => 'FilterPanel'],
        ],
        'chipsTitle' => [
            'control' => 'text',
            'description' => 'Title for the chips section',
            'defaultValue' => ['summary' => 'Selected filters'],
        ],
        'headingLevel' => [
            'control' => 'number',
            'description' => 'The heading level to use for the title',
            'defaultValue' => ['summary' => 2],
        ],
        'modalId' => [
            'control' => 'text',
            'description' => 'ID of the modal, used with modal trigger buttons, e.g. [data-modal-target="#filtersPanel"], to open the panel',
            'defaultValue' => ['summary' => 'filtersPanel'],
        ],
        'modalVariant' => [
            'control' => 'text',
            'description' => 'Variant name used for styling in modal JSON file',
            'defaultValue' => ['summary' => 'filters'],
        ],
        'useSwup' => [
            'control' => 'boolean',
            'description' => 'Controls the use of Swup for page transitions',
            'defaultValue' => ['summary' => false],
        ],
        'applyButtonVariant' => [
            'control' => 'text',
            'description' => 'Variant name for the apply button',
            'defaultValue' => ['summary' => 'primary'],
        ],
        'resetButtonVariant' => [
            'control' => 'text',
            'description' => 'Variant name for the reset button',
            'defaultValue' => ['summary' => 'secondary'],
        ],
    ],
])

<x-vui-filters-panel :title="$title"
                     :filters="$filters"
                     :show-chips="true"
                     :open="true"
                     apply-button-variant="secondary" />
