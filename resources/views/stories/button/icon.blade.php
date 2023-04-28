@storybook([
    'status' => 'readyForQA',
    'name' => 'With Icon',
    'preset' => 'button.icon',
])

<x-vui-button-icon
    :href="$href ?? null"
    :icon="$icon ?? null"
    :static="$static ?? null"
    :inverse="$inverse ?? null"
    :disabled="$disabled ?? null"
    :active="$active ?? null"
    :size="$size ?? null"
/>
