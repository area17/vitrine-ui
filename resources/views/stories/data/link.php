<?php

return [
    'base' => [
        'args' => [
            'label' => 'Label',
            'href' => '',
            'icon' => '',
            'iconPosition' => 'before',
            'active' => false,
            'static' => false,
            'disabled' => false,
            'inverse' => false,
        ],
        'argTypes' => [
            'label' => [
                'description' => 'Plain text used within the link',
                'defaultValue' => ['summary' => ''],
            ],
            'href' => [
                'description' =>
                    'The `href` string to use on an `a` element. If this prop is set to `falsey` value the component will render as a `button`, unless `static` prop (see below) is set to `true`. If both `static` and `href` props are set, the `href` prop is ignored and the component is rendered as a `span`.',
                'defaultValue' => ['summary' => ''],
            ],
            'icon' => [
                'control' => 'select',
                'options' => [false, 'plus-16', 'arrow-bottom-right-16', 'minus-16'],
                'description' =>
                    'The name of the icon file to use in the button. Can be positioned with the iconPosition prop (see below). Rendered using the `x-a17-icon` component.',
                'defaultValue' => ['summary' => false],
            ],
            'iconPosition' => [
                'control' => 'radio',
                'options' => ['Before' => 'before', 'After' => 'after', 'Hover' => 'hover'],
                'description' =>
                    'Defines the position of the icon in respect to the text, either `before` or `after`. Has no effect if used without the icon prop.',
                'defaultValue' => ['summary' => 'after'],
            ],
            'active' => [
                'description' => 'Renders the link in it\'s active/selected state.',
                'defaultValue' => ['summary' => false],
            ],
            'static' => [
                'description' =>
                    'This prop allows the component to be used within block links where you need an element to look like a button. Setting this to true will render the button as span.',
                'defaultValue' => ['summary' => false],
            ],
            'disabled' => [
                'description' => 'Adds the `disabled` attribute to the component',
                'defaultValue' => ['summary' => false],
            ],
            'inverse' => [
                'description' => 'Flips the colors on the button. Set to `true` when using on dark backgrounds',
                'defaultValue' => ['summary' => false],
            ],
        ],
    ],
];
