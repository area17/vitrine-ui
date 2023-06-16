@storybook([
    'status' => 'readyForQA',
    'name' => 'With Icon',
    'preset' => 'button.icon',
])

<x-vui-button
    :href="$href ?? null"
    :icon="$icon ?? null"
    :iconOnly="true"
    :static="$static ?? null"
    :inverse="$inverse ?? null"
    :disabled="$disabled ?? null"
    :active="$active ?? null"
    :size="$size ?? null"
/>
