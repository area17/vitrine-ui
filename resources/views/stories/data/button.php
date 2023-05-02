<?php
// Hurrah!
return [
    'base' => [
        'args' => [
            'label' => 'Label',
            'href' => '',
            'icon' => false,
            'iconPosition' => 'after',
            'static' => false,
            'disabled' => false,
        ],
        'argTypes' => [
            'label' => [
                'description' => 'Plain text used within the button',
                'defaultValue' => ['summary' => ''],
            ],
            'href' => [
                'description' =>
                    'The `href` string to use on an `a` element. If this prop is set to `falsey` value the component will render as a `button`, unless `static` prop (see below) is set to `true`. If both `static` and `href` props are set, the `href` prop is ignored and the component is rendered as a `span`.',
                'defaultValue' => ['summary' => ''],
            ],
            'icon' => [
                'control' => 'select',
                'options' => [false, 'close-24', 'arrow-left-24', 'arrow-right-24'],
                'description' =>
                    'The name of the icon file to use in the button. Can be positioned with the iconPosition prop (see below). Rendered using the `x-vui-icon` component.',
                'defaultValue' => ['summary' => false],
            ],
            'iconPosition' => [
                'control' => 'radio',
                'options' => ['Before' => 'before', 'After' => 'after'],
                'description' =>
                    'Defines the position of the icon in respect to the text, either `before` or `after`. Has no effect if used without the icon prop.',
                'defaultValue' => ['summary' => 'after'],
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
        ],
    ],
    'icon' => [
        'args' => [
            'href' => '',
            'icon' => 'plus-24',
            'static' => false,
            'disabled' => false,
            'size' => 'small',
        ],
        'argTypes' => [
            'href' => [
                'description' =>
                    'The `href` string to use on an `a` element. If this prop is set to `falsey` value the component will render as a `button`, unless `static` prop (see below) is set to `true`. If both `static` and `href` props are set, the `href` prop is ignored and the component is rendered as a `span`.',
                'defaultValue' => ['summary' => ''],
            ],
            'icon' => [
                'control' => 'select',
                'options' => ['close-24', 'plus-24', 'arrow-right-24'],
                'description' =>
                    'The name of the icon file to use in the button. Rendered using the `x-a17-icon` component.',
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
            'size' => [
                'control' => 'select',
                'options' => ['small', 'medium', 'large'],
                'description' => 'Sets the size of the button. Doesnt resize the icon.',
                'defaultValue' => ['summary' => 'small'],
            ],
        ],
    ],
];
