@storybook([
    'status' => 'readyForQA',
    'args' => [
        'label' => 'Select name',
        'name' => 'username',
        'id' => '',
        'disabled' => false,
        'required' => false,
        'options' => [
            [
                'value' => 'Item 1',
                'selected' => false, // selected can be ommited for brevity
            ],
            [
                'value' => 'Item 2',
            ],
            [
                'value' => 'Item 3'
            ],
            [
                'value' => 'Item 4'
            ]
        ],
        'placeholder' => '', // placeholder will show up if added and be unselectable
        'error' => '',
        'hint' => '',
        'note' => '',
        'form' => '',
        'autocomplete' => '',
        'autofocus' => false,
        'multiple' => false,
        'readonly' => false,
    ]
])

<div style="min-width: 500px;">
    <x-vui-form-select
        :label="$label ?? ''"
        :name="$name ?? ''"
        :id="$id ?? ''"
        :disabled="$disabled ?? ''"
        :required="$required ?? ''"
        :options="$options ?? ''"
        :placeholder="$placeholder ?? ''"
        :error="$error ?? ''"
        :hint="$hint ?? ''"
        :note="$note ?? ''"
        :form="$form ?? ''"
        :autocomplete="$autocomplete ?? ''"
        :autofocus="$autofocus ?? ''"
        :multiple="$multiple ?? ''"
        :readonly="$readonly ?? ''"
    />
</div>
