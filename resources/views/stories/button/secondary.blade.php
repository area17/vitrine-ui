@storybook([
    'status' => 'readyForQA',
    'preset' => 'button.base'
])

<x-vui-button-secondary
    :href="$href ?? null"
    :icon="$icon ?? null"
    :icon-position="$iconPosition ?? null"
    :static="$static ?? null"
    :disabled="$disabled ?? null"
    :active="$active ?? null"
>
    {{ $label ?? null }}
</x-vui-button-secondary>
