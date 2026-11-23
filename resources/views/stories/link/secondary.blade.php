@storybook([
    'order' => 2,
    'status' => 'readyForQA',
    'preset' => 'link.base',
])

<x-vui-link :href="$href ?? null"
            :icon="$icon ?? null"
            :icon-position="$iconPosition ?? 'after'"
            :static="$static ?? false"
            :disabled="$disabled ?? null"
            variant="secondary">
    {{ $label ?? 'Link' }}
</x-vui-link>
