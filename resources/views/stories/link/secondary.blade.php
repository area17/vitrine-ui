@storybook([
    'order' => 2,
    'status' => 'readyForQA',
    'preset' => 'link.base',
])

<x-vui-link :href="$href ?? null"
            :icon="$icon ?? null"
            :icon-position="$iconPosition ?? null"
            :static="$static ?? null"
            :disabled="$disabled ?? null"
            :active="$active ?? null"
            variant="primary">
    {{ $label ?? 'Link' }}
</x-vui-link>
