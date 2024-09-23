@storybook([
    'status' => 'readyForQA',
    'args' => [
        'legend' => 'Sizes',
        'disabled' => false,
        'hint' => '',
        'note' => '',
        'options' => [
            [
                'label' => 'Small',
                'name' => 'small',
                'id' => '',
                'value' => 'small',
                'disabled' => false,
                'selected' => false,
                'required' => false,
                'error' => '',
                'hint' => '',
                'note' => '',
                'inputAttr' => '',
                'autofocus' => false,
                'form' => '',
            ],
            [
                'label' => 'Medium',
                'name' => 'medium',
                'id' => '',
                'value' => 'medium',
                'disabled' => false,
                'selected' => false,
                'required' => false,
                'error' => '',
                'hint' => '',
                'note' => '',
                'inputAttr' => '',
                'autofocus' => false,
                'form' => '',
            ],
            [
                'label' => 'Large',
                'name' => 'large',
                'id' => '',
                'value' => 'large',
                'disabled' => false,
                'selected' => false,
                'required' => false,
                'error' => '',
                'hint' => '',
                'note' => '',
                'inputAttr' => '',
                'autofocus' => false,
                'form' => '',
            ],
        ],
    ],
])

<div style="min-width: 500px;">
    <x-vui-form-checkbox-group :options="$options"
                               :legend="$legend"
                               :disabled="$disabled"
                               :hint="$hint"
                               :note="$note" />
</div>
