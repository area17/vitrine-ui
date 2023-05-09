@storybook([
    'status' => 'readyForQA',
    'args' => [
        'target' => '',
        'class' => 'relative',
        'align' => '',
        'range' => true,
        'minDate' => '',
        'maxDate' => '',
    ]
])

<div style="min-width: 300px; max-width: 600px; margin: 0 auto;">
    <div style="margin: 0 auto; width: 24px;">
        <x-vui-datepicker
            :target="$target ?? null"
            :class="$class ?? null"
            :align="$align ?? null"
            :range="$range ?? null"
            :min-date="$minDate ?? null"
            :max-date="$maxDate ?? null"
        />
    </div>
    <hr class="mt-60 border-t-quaternary">
    <p class="f-body-1 mt-40">The popup either requires a <code class="inline-block inline-block f-ui-1 bg-quaternary px-4 py-1 px-4 py-1">position: relative;</code> container or for the datepicker itself to have <code class="inline-block inline-block f-ui-1 bg-quaternary px-4 py-1 px-4 py-1">position: relative;</code>.</p>
    <p class="f-body-1 mt-20">Alignment options are basic, top aligned, left or right aligned - with the switch currently powered by Tailwind classes.</p>
    <p class="f-body-1 mt-20">Its important to note that you will need vertical space, possibly scroll space below - take extra care if you're launching this from a fixed/sticky element.</p>
</div>
