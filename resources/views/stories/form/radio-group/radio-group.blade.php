@storybook([
    'status' => 'readyForQA',
    'args' => [
        'legend' => 'Sizes',
        'name' => 'size',
        'disabled' => false,
        'required' => true,
        'error' => '',
        'hint' => '',
        'note' => '',
        'options' => [
            [
                'label' => 'Small',
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
            ]
        ]
    ]

])

<div style="min-width: 500px;">
    <x-vui-form-radio-group
        :options="$options"
        :legend="$legend"
        :required="$required"
        :name="$name"
        :error="$error"
        :disabled="$disabled"
        :hint="$hint"
        :note="$note"
    />
</div>
