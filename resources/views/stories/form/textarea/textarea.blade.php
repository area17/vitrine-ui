@storybook([
    'status' => 'readyForQA',
    'args' => [
        'label' => 'Questions',
        'name' => 'questions',
        'id' => '',
        'value' => '',
        'disabled' => false,
        'required' => true,
        'placeholder' => '', // placeholder will show up if added and be unselectable
        'error' => '',
        'hint' => '',
        'note' => '',
        'autocomplete' => '',
        'autofocus' => false,
        'form' => '',
        'maxlength' => '',
        'minlength' => '',
        'readonly' => false,
        'spellcheck' => '',
        'wrap' => '',
    ],
])

<div style="min-width: 500px;">
    <x-vui-form-textarea :label="$label ?? ''"
                         :name="$name ?? ''"
                         :id="$id ?? ''"
                         :value="$value ?? ''"
                         :disabled="$disabled ?? ''"
                         :required="$required ?? ''"
                         :placeholder="$placeholder ?? ''"
                         :error="$error ?? ''"
                         :hint="$hint ?? ''"
                         :note="$note ?? ''"
                         :autocomplete="$autocomplete ?? ''"
                         :autofocus="$autofocus ?? ''"
                         :form="$form ?? ''"
                         :maxlength="$maxlength ?? ''"
                         :minlength="$minlength ?? ''"
                         :readonly="$readonly ?? ''"
                         :spellcheck="$spellcheck ?? ''"
                         :wrap="$wrap ?? ''" />
</div>
