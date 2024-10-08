@storybook([
    'status' => 'readyForQA',
    'args' => [
        'target' => '',
        'class' => 'relative',
        'align' => '',
        'range' => false,
        'minDate' => '',
        'maxDate' => '',
    ],
    'argTypes' => [
        'target' => [
            'description' => 'A CSS selector for the input field or element that the datepicker should be attached to.',
            'defaultValue' => ['summary' => ''],
            'control' => 'text',
        ],
        'class' => [
            'description' => 'Additional CSS classes for the datepicker wrapper.',
            'defaultValue' => ['summary' => 'relative'],
            'control' => 'text',
        ],
        'align' => [
            'description' => 'Alignment of the datepicker popup relative to the target element. Options are `left` or `right`.',
            'defaultValue' => ['summary' => 'right'],
            'control' => 'select',
            'options' => ['left', 'right'],
        ],
        'range' => [
            'description' => 'If set to `true`, enables date range selection. If `false`, only single-date selection is enabled.',
            'defaultValue' => ['summary' => false],
            'control' => 'boolean',
        ],
        'minDate' => [
            'description' => 'The earliest selectable date, in ISO format (YYYY-MM-DD).',
            'defaultValue' => ['summary' => ''],
            'control' => 'text',
        ],
        'maxDate' => [
            'description' => 'The latest selectable date, in ISO format (YYYY-MM-DD).',
            'defaultValue' => ['summary' => ''],
            'control' => 'text',
        ],
    ],
])

<div style="min-width: 300px; max-width: 600px; margin: 0 auto;">
    <div style="margin: 0 auto; width: 24px;">
        <x-vui-datepicker :target="$target ?? null"
                          :class="$class ?? null"
                          :align="$align ?? null"
                          :range="$range ?? null"
                          :min-date="$minDate ?? null"
                          :max-date="$maxDate ?? null" />
    </div>
    <hr class="mt-60 border-t-quaternary">
    <p class="f-body-1 mt-40">The popup either requires a <code
              class="f-ui-1 inline-block inline-block bg-quaternary px-4 px-4 py-1 py-1">position: relative;</code>
        container or for the datepicker itself to have <code
              class="f-ui-1 inline-block inline-block bg-quaternary px-4 px-4 py-1 py-1">position: relative;</code>.</p>
    <p class="f-body-1 mt-20">Alignment options are basic, top aligned, left or right aligned - with the switch currently
        powered by Tailwind classes.</p>
    <p class="f-body-1 mt-20">Its important to note that you will need vertical space, possibly scroll space below - take
        extra care if you're launching this from a fixed/sticky element.</p>
    <p class="f-body-1 mt-20"><code
              class="f-ui-1 inline-block inline-block bg-quaternary px-4 px-4 py-1 py-1">minDate</code> and <code
              class="f-ui-1 inline-block inline-block bg-quaternary px-4 px-4 py-1 py-1">maxDate</code> expect an ISO
        <code class="f-ui-1 inline-block inline-block bg-quaternary px-4 px-4 py-1 py-1">YYYY-MM-DD</code> format.
    </p>
</div>
