@storybook([
    'order' => 2,
    'status' => 'readyForQA',
    'preset' => 'link.base'
])

<x-vui-link-secondary
    :href="$href ?? null"
    :icon="$icon ?? null"
    :icon-position="$iconPosition ?? null"
    :static="$static ?? null"
    :disabled="$disabled ?? null"
    :active="$active ?? null"
>
    {{ $label ?? 'Link' }}
</x-vui-link-secondary>
