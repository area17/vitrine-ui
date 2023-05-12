@storybook([
    'status' => 'readyForQA',
    'args' => [
        'label' => 'First name',
        'name' => 'username',
        'id' => '',
        'value' => '',
        'placeholder' => 'placeholder',
        'disabled' => false,
        'required' => true,
        'error' => '',
        'hint' => '',
        'note' => '',
        'allowed' => 'image/png, image/jpeg',
        'fileSize' => 5,
        'autofocus' => '',
        'multiple' => '',
        'readonly' => '',
    ]
])

<div style="min-width: 500px;">
    <x-vui-form-upload
        :label="$label ?? ''"
        :disabled="$disabled ?? ''"
        :name="$name ?? ''"
        :id="$id ?? ''"
        :required="$required ?? ''"
        :allowed="$allowed ?? ''"
        :fileSize="$fileSize ?? ''"
        :error="$error ?? ''"
        :hint="$hint ?? ''"
        :note="$note ?? ''"
        :autofocus="$autofocus ?? ''"
        :multiple="$multiple ?? ''"
        :readonly="$readonly ?? ''"
    />
</div>
