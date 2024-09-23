@storybook([
    'status' => 'readyForQA',
    'args' => [
        'label' => 'Date',
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
        'fuzzy' => true,
        'picker' => true,
        'autofocus' => false,
        'form' => '',
        'readonly' => false,
        'dataAttrs' => '',
        'hideA11yLabels' => false,
    ],
])

<div style="min-width: 300px; max-width: 600px; margin: 0 auto;">
    <x-vui-form-date :label="$label ?? ''"
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
                     :fuzzy="$fuzzy ?? ''"
                     :picker="$picker ?? ''"
                     :autofocus="$autofocus ?? ''"
                     :form="$form ?? ''"
                     :readonly="$readonly ?? ''"
                     :dataAttrs="$dataAttrs ?? ''"
                     :hideA11yLabels="$hideA11yLabels ?? ''" />
    <hr class="mt-60 border-t-quaternary">
    <p class="f-body-1 mt-40">This fuzzy input behavior is largely the same as its non "<a class="underline"
           href="/?path=/story/molecules-form-date--strict">strict input</a>" counterpart - this just includes an
        updated parsing method.</p>
    <p class="f-body-1 mt-20">The behavior <code
              class="f-ui-1 inline-block bg-quaternary px-4 py-1">DatePickerFuzzy</code> imports and runs the <code
              class="f-ui-1 inline-block bg-quaternary px-4 py-1">DatePicker</code> behavior, to inherit the picker popup
        behavior etc. - but supplies an updated <code
              class="f-ui-1 inline-block inline-block bg-quaternary px-4 px-4 py-1 py-1">parseInput</code> method to
        fuzzy
        process manual input.</p>
    <p class="f-body-1 mt-20">Fuzzy manual input processing is powered by <a class="underline"
           href="https://github.com/area17/parse-numeric-date"
           target="_blank">area17/parse-numeric-date</a>.</p>
    <p class="f-body-1 mt-20">The date picker popup is optional: <code
              class="f-ui-1 inline-block inline-block bg-quaternary px-4 px-4 py-1 py-1">:picker="true/false"</code></p>
    <p class="f-body-1 mt-20"><code
              class="f-ui-1 inline-block inline-block bg-quaternary px-4 px-4 py-1 py-1">value</code>, <code
              class="f-ui-1 inline-block inline-block bg-quaternary px-4 px-4 py-1 py-1">minDate</code> and <code
              class="f-ui-1 inline-block inline-block bg-quaternary px-4 px-4 py-1 py-1">maxDate</code> expect an ISO
        <code class="f-ui-1 inline-block inline-block bg-quaternary px-4 px-4 py-1 py-1">YYYY-MM-DD</code> format.
    </p>
</div>
