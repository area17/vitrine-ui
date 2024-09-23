@storybook([
    'status' => 'readyForQA',
    'args' => [
        'legend' => 'Date',
        'name' => 'date',
        'id' => '',
        'value' => '',
        'disabled' => false,
        'required' => false,
        'error' => '',
        'hint' => '',
        'note' => '',
        'minDate' => '',
        'maxDate' => '',
        'picker' => true,
        'autofocus' => false,
        'form' => '',
        'readonly' => false,
        'dataAttrs' => '',
        'hideA11yLabels' => false,
    ],
])

<form style="min-width: 300px; max-width: 600px; margin: 0 auto;">
    <x-vui-form-date-trio :legend="$legend ?? ''"
                          :name="$name ?? ''"
                          :id="$id ?? ''"
                          :value="$value ?? ''"
                          :error="$error ?? ''"
                          :disabled="$disabled ?? ''"
                          :required="$required ?? ''"
                          :error="$error ?? ''"
                          :hint="$hint ?? ''"
                          :note="$note ?? ''"
                          :minDate="$minDate ?? ''"
                          :maxDate="$maxDate ?? ''"
                          :picker="$picker ?? ''"
                          :autofocus="$autofocus ?? ''"
                          :form="$form ?? ''"
                          :readonly="$readonly ?? ''"
                          :dataAttrs="$dataAttrs ?? ''"
                          :hideA11yLabels="$hideA11yLabels ?? ''" />
</form>
