@storybook([
    'status' => 'readyForQA',
    'args' => [
        'label' => 'First name',
        'name' => 'username',
        'id' => '',
        'type' => 'text',
        'value' => '',
        'placeholder' => 'placeholder',
        'disabled' => false,
        'required' => false,
        'error' => '',
        'hint' => '',
        'note' => '',
        'inputmode' => '',
        'pattern' => '',
        'autocomplete' => '',
        'autofocus' => false,
        'form' => '',
        'list' => '',
        'max' => '',
        'maxlength' => '',
        'min' => '',
        'minlength' => '',
        'multiple' => false,
        'readonly' => false,
        'step' => ''
    ]
])

<div style="min-width: 500px;">
    <x-vui-form-input
        :label="$label ?? ''"
        :name="$name ?? ''"
        :id="$id ?? ''"
        :type="$type ?? ''"
        :value="$value ?? ''"
        :placeholder="$placeholder ?? ''"
        :disabled="$disabled ?? ''"
        :required="$required ?? ''"
        :error="$error ?? ''"
        :hint="$hint ?? ''"
        :note="$note ?? ''"
        :inputmode="$inputmode ?? ''"
        :pattern="$pattern ?? ''"
        :autocomplete="$autocomplete ?? ''"
        :autofocus="$autofocus ?? ''"
        :form="$form ?? ''"
        :list="$list ?? ''"
        :max="$max ?? ''"
        :maxlength="$maxlength ?? ''"
        :min="$min ?? ''"
        :minlength="$minlength ?? ''"
        :multiple="$multiple ?? ''"
        :readonly="$readonly ?? ''"
        :step="$step ?? ''"
    />
</div>
