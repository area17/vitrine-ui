@storybook([
    'status' => 'readyForQA',
    'args' => [
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
    ]

])

<div style="min-width: 500px;">
    <x-vui-form-checkbox
        :label="$label ?? ''"
        :name="$name ?? ''"
        :id="$id ?? ''"
        :value="$value ?? ''"
        :disabled="$disabled ?? ''"
        :required="$required ?? ''"
        :selected="$selected ?? ''"
        :error="$error ?? ''"
        :hint="$hint ?? ''"
        :note="$note ?? ''"
        :inputAttr="$inputAttr"
        :autofocus="$autofocus ?? ''"
        :form="$form ?? ''"
    />
</div>
