@storybook([
    'status' => 'readyForQA',
    'preset' => 'link.base',
])

<x-vui-link :href="$href ?? null"
            :icon="$icon ?? null"
            :icon-position="$iconPosition ?? 'after'"
            :static="$static ?? false"
            :disabled="$disabled ?? null"
            variant="primary">
    {{ $label ?? 'Link' }}
</x-vui-link>
