@storybook([
    'status' => 'readyForQA',
    'preset' => 'link.base'
])

<x-vui-link-primary
    :href="$href ?? null"
    :icon="$icon ?? null"
    :icon-position="$iconPosition ?? null"
    :static="$static ?? null"
    :inverse="$inverse ?? null"
    :disabled="$disabled ?? null"
    :active="$active ?? null"
>
    {{ $label ?? 'Link' }}
</x-vui-link-primary>
