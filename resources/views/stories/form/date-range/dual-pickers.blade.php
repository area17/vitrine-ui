@storybook([
    'status' => 'readyForQA',
    'args' => [
        'legend' => 'Select date range',
        'disabled' => false,
        'minDate' => '',
        'maxDate' => '',
        'hint' => '',
        'note' => '',
        'picker' => false,
        'from' => [
            'label' => 'From',
            'name' => 'from',
            'type' => 'text',
            'value' => '',
            'disabled' => false,
            'error' => '',
            'minDate' => '',
            'maxDate' => '',
            'fuzzy' => false,
            'picker' => true,
            'hint' => '',
            'note' => '',
        ],
        'to' => [
            'label' => 'To',
            'name' => 'to',
            'type' => 'text',
            'value' => '',
            'disabled' => false,
            'error' => '',
            'minDate' => '',
            'maxDate' => '',
            'fuzzy' => false,
            'picker' => true,
            'hint' => '',
            'note' => '',
        ],
    ]
])

<div style="min-width: 300px; max-width: 600px; margin: 0 auto;">
    <x-vui-form-date-range
        :legend="$legend"
        :disabled="$disabled"
        :minDate="$minDate"
        :maxDate="$maxDate"
        :picker="$picker"
        :to="$to"
        :from="$from"
    />
    <hr class="mt-60 border-t-quaternary">
    <p class="f-body-1 mt-40">This uses 2 date inputs, paired together in a parent element with a parent behavior to synchronise them together along with the optional date picker popup. These date inputs have the optional "<a href="/?path=/story/molecules-form--date-fuzzy" class="underline">fuzzy input</a>" input parsing active.</p>
    <p class="f-body-1 mt-20">The date picker popups are optional, by setting <code class="inline-block inline-block f-ui-1 bg-quaternary px-4 py-1 px-4 py-1">:picker="true/false"</code> on the inputs.</p>
    <p class="f-body-1 mt-20">There is also a "<a href="/?path=/story/molecules-form-daterange--single-picker" class="underline">single picker</a>" version, which has a single date picker popup.</p>
    <p class="f-body-1 mt-20"><code class="inline-block inline-block f-ui-1 bg-quaternary px-4 py-1 px-4 py-1">value</code>, <code class="inline-block inline-block f-ui-1 bg-quaternary px-4 py-1 px-4 py-1">minDate</code> and <code class="inline-block inline-block f-ui-1 bg-quaternary px-4 py-1 px-4 py-1">maxDate</code> expect an ISO <code class="inline-block inline-block f-ui-1 bg-quaternary px-4 py-1 px-4 py-1">YYYY-MM-DD</code> format.</p>
</div>
