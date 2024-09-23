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
        'fuzzy' => false,
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
    <p class="f-body-1 mt-40">Manual entry of this date picker is looking for a strict <code
              class="f-ui-1 inline-block inline-block bg-quaternary px-4 px-4 py-1 py-1">YYYY-MM-DD</code
               class="f-ui-1 inline-block bg-quaternary px-4 py-1"> input - if a user enters <code
              class="f-ui-1 inline-block bg-quaternary px-4 py-1">YYYY-MM-D</code
               class="f-ui-1 inline-block bg-quaternary px-4 py-1">/<code
              class="f-ui-1 inline-block bg-quaternary px-4 py-1">YYYY-M-DD</code
               class="f-ui-1 inline-block bg-quaternary px-4 py-1">/<code
              class="f-ui-1 inline-block bg-quaternary px-4 py-1">YYYY-M-D</code
               class="f-ui-1 inline-block bg-quaternary px-4 py-1"> then there input will be correctly interpreted as
        long
        as its in <code class="f-ui-1 inline-block bg-quaternary px-4 py-1">Y-M-D</code
               class="f-ui-1 inline-block bg-quaternary px-4 py-1"> order.</p>
    <p class="f-body-1 mt-20">There is a "<a class="underline"
           href="/?path=/story/molecules-form-date--fuzzy">fuzzy
            input</a>" option: <code
              class="f-ui-1 inline-block inline-block bg-quaternary px-4 px-4 py-1 py-1">:fuzzy="true/false"</code><br>Which
        would attempt to understand any numeric input using <a class="underline"
           href="https://github.com/area17/parse-numeric-date"
           target="_blank">area17/parse-numeric-date</a></p>
    <p class="f-body-1 mt-20">The date picker popup is optional: <code
              class="f-ui-1 inline-block inline-block bg-quaternary px-4 px-4 py-1 py-1">:picker="true/false"</code></p>
    <p class="f-body-1 mt-20"><code
              class="f-ui-1 inline-block inline-block bg-quaternary px-4 px-4 py-1 py-1">value</code>, <code
              class="f-ui-1 inline-block inline-block bg-quaternary px-4 px-4 py-1 py-1">minDate</code> and <code
              class="f-ui-1 inline-block inline-block bg-quaternary px-4 px-4 py-1 py-1">maxDate</code> expect an ISO
        <code class="f-ui-1 inline-block inline-block bg-quaternary px-4 px-4 py-1 py-1">YYYY-MM-DD</code> format.
    </p>
</div>
