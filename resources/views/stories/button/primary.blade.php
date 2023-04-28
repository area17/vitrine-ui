@storybook([
    'status' => 'readyForQA',
    'preset' => 'button.base'
])

<x-vui-button-primary
    :href="$href ?? null"
    :icon="$icon ?? null"
    :icon-position="$iconPosition ?? null"
    :static="$static ?? null"
    :disabled="$disabled ?? null"
    :active="$active ?? null"
>
    {{ $label ?? null }}
</x-vui-button-primary>
