{{--
for documentation on range api on 'options' prop:
https://www.npmjs.com/package/range-slider-input
--}}

@storybook([
    'status' => 'readyForQA',
    'order' => 2,
    'args' => [
        'label' => 'Sizes',
        'name' => 'size',
        'disabled' => false,
        'required' => true,
        'error' => '',
        'hideLower' => false, // visually represent a single slide
        'showOutput' => true,
        'options' => [
            'value' => [0, 50],
            'rangeSlideDisabled' => true,
        ],
    ],
])

<div style="min-width: 500px;">
    <x-vui-form-range :label="$label"
                      :required="$required"
                      :name="$name"
                      :error="$error"
                      :disabled="$disabled"
                      :options="$options"
                      :showOutput="$showOutput"
                      :hideLower="$hideLower" />
</div>
