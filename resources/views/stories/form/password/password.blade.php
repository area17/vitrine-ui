@storybook([
    'status' => 'readyForQA',
    'args' => [
        'label' => 'Password',
        'name' => 'password',
        'id' => '',
        'value' => 'foobar',
        'placeholder' => '',
        'disabled' => false,
        'required' => false,
        'error' => '',
        'hint' => '',
        'note' => '',
        'autocomplete' => '',
        'autofocus' => false,
        'form' => '',
        'readonly' => false,
    ]
])

<div style="min-width: 500px;">
    <x-vui-form-password
        :label="$label ?? ''"
        :name="$name ?? ''"
        :id="$id ?? ''"
        :value="$value ?? ''"
        :placeholder="$placeholder ?? ''"
        :disabled="$disabled ?? ''"
        :required="$required ?? ''"
        :error="$error ?? ''"
        :hint="$hint ?? ''"
        :note="$note ?? ''"
        :autocomplete="$autocomplete ?? ''"
        :autofocus="$autofocus ?? ''"
        :form="$form ?? ''"
        :readonly="$readonly ?? ''"
    />
</div>
